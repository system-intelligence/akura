# Email Verification Flow Implementation Guide

## 🎯 Problem Statement

**Original Issue:** Users who click expired verification links are trapped:
- Cannot log in (email unverified)
- Cannot create new account (email already taken)
- No clear recovery path

---

## 📋 Requirements Analysis

### Functional Requirements
1. Detect unverified users during login
2. Provide resend verification option on login page
3. Handle expired verification links gracefully
4. Handle non-existent email addresses
5. Centralize verification logic in AuthService

### Non-Functional Requirements
- Rate limiting (already built into Laravel)
- Clear user feedback
- No information leakage (don't reveal if email exists)
- Reusable business logic

---

## 🗺️ Architecture & Components

```
┌─────────────────┐
│   Login Page    │ ← User enters email
│   (LoginForm)   │
└────────┬────────┘
         │
         ▼
┌─────────────────┐      ┌─────────────────┐
│   Validation    │─────▶│   User exists?  │
└────────┬────────┘      └────────┬────────┘
         │                         │
         ▼                         ▼
    ┌────┴─────┐           ┌──────┴─────┐
    │ Pass      │           │ No         │
    └────┬──────┘           └─────┬──────┘
         │                        │
         ▼                        ▼
   ┌────────────┐         ┌─────────────┐
   │   Check     │         │ Show:       │
   │ Password    │         │ "Email not  │
   └─────┬───────┘         │  found"     │
         │                 │ + "Create   │
         ▼                 │  account"   │
   ┌──────────────┐        └─────────────┘
   │  Login via   │
   │  AuthService │
   └──────┬───────┘
          │
          ▼
   ┌──────────────┐
   │ Dashboard    │
   └──────────────┘
```

**Unverified Flow (email exists but unverified):**
```
┌──────────────┐
│  User found  │
│  but email   │
│  unverified  │
└──────┬───────┘
       │
       ▼
┌──────────────────┐
│ Show error:      │
│ "Please verify   │
│  your email"     │
│ + "Resend link"  │
└────────┬─────────┘
         │
         ▼
┌──────────────────┐
│ resend() calls   │
│ AuthService→     │
│ notify() sends   │
│ fresh verification│
│ email (60 min)   │
└──────────────────┘
```

---

## 🔄 Complete Data Flow

### 1. Login Submission Flow

**File:** `app/Livewire/Auth/LoginForm.php`

```php
public function login(AuthService $authService)
{
    // STEP 1: Validate input
    $this->validate(); // email, password required
    
    // STEP 2: Fetch user by email
    $user = User::where('email', $this->email)->first();
    
    // BRANCH A: User doesn't exist
    if (! $user) {
        $this->emailNotFound = true;
        $this->addError('email', 'This email has not been used...');
        return; // STOP - show create account option
    }
    
    // BRANCH B: User exists but email unverified
    if ($user->email_verified_at === null) {
        session()->put('pending_verification_email', $user->email);
        $this->showResendLink = true;
        $this->addError('email', 'Please verify your email first.');
        return; // STOP - show resend option
    }
    
    // BRANCH C: User exists and email verified
    if ($authService->login([...])) {
        return redirect()->route('dashboard');
    }
    
    $this->addError('email', 'Invalid credentials.');
}
```

**Key Decisions:**
- Check `email_verified_at === null` for unverified
- Store in session: `pending_verification_email` for resend page fallback
- Early returns prevent further execution

### 2. Resend Verification Flow

**File:** `app/Livewire/Auth/LoginForm.php:75`

```php
public function resendVerification(AuthService $authService)
{
    // Re-validate email format
    $this->validate(['email' => 'required|email']);
    
    $user = User::where('email', $this->email)->first();
    
    // SCENARIO 1: Email doesn't exist
    if (! $user) {
        $this->emailNotFound = true;
        $this->addError('email', 'This email has not been used...');
        return;
    }
    
    // SCENARIO 2: Already verified
    if ($user->hasVerifiedEmail()) {
        $this->addError('email', 'This email is already verified.');
        return;
    }
    
    // SCENARIO 3: Valid unverified user → resend
    $authService->resendVerification($user);
    session()->flash('status', 'Verification email resent!');
}
```

### 3. AuthService Centralization

**File:** `app/Services/AuthService.php`

```php
class AuthService
{
    // ... other methods ...
    
    public function resendVerification(User $user): void
    {
        // Guard: only resend if not verified
        if (! $user->hasVerifiedEmail()) {
            $user->notify(new VerifyEmailNotification);
        }
    }
}
```

**Why centralize?**
- Single responsibility: all email auth logic in one place
- Reusable: both LoginForm and VerifyEmailNotice use it
- Testable: business logic isolated from UI
- Maintainable: change notification logic in one file

### 4. Verification Link Expiry

**File:** `routes/web.php:43`

```php
Route::get('/email/verify/{id}/{hash}', function ($id, $hash) {
    $user = User::findOrFail($id);
    
    // STEP 1: Validate hash (prevents tampering)
    if (! hash_equals(sha1($user->getEmailForVerification()), $hash)) {
        abort(403);
    }
    
    // STEP 2: Check if already verified
    if ($user->hasVerifiedEmail()) {
        return redirect()->route('login')
            ->with('status', 'Email already verified!');
    }
    
    // STEP 3: Check signature expiry (THE KEY STEP)
    if (! request()->hasValidSignature()) {
        // Link is expired → redirect to resend page
        return redirect()->route('verification.notice')
            ->with('error', 'Your verification link has expired...');
    }
    
    // STEP 4: Mark as verified
    $user->email_verified_at = now();
    $user->save();
    
    session()->forget('pending_verification_email');
    
    return redirect()->route('login')
        ->with('status', 'Email verified! You can now login.');
});
```

**How `hasValidSignature()` works:**
```
Signed URL format: 
/email/verify/{id}/{hash}?expires=1745425800&signature=abc123...

Laravel's check:
1. Extract expires timestamp from URL
2. If expires < now() → EXPIRED
3. Generate HMAC signature from: id + hash + expires
4. Compare with provided signature
5. Match & not expired → VALID
```

Default expiry: **60 minutes** (set in `VerifyEmailNotification.php:20`)

---

## 🎨 UI/UX State Management

### Livewire Component State

```php
class LoginForm extends Component
{
    // User input
    public $email = '';
    public $password = '';
    public $remember = false;
    
    // UI state flags
    public $showResendLink = false;   // Show resend button
    public $resendEmail = '';         // Email to resend to
    public $emailNotFound = false;    // Flag for non-existent email
    
    // Livewire automatically syncs these to view
}
```

**State Transitions:**

| Event | State Change |
|-------|-------------|
| Page load | all flags false |
| User types email | `emailNotFound = false`, `showResendLink = false` |
| Login with non-existent email | `emailNotFound = true` |
| Login with unverified email | `showResendLink = true` |
| Resend clicked (success) | flash message, `showResendLink = false` |
| Resend clicked (email not found) | `emailNotFound = true` |

---

## 🔐 Security Considerations

### 1. Rate Limiting
Laravel's `EnsureEmailIsVerified` middleware automatically throttles:
- Verification attempts per user/IP
- Built into Laravel's auth system

### 2. No Information Leakage
**Bad:** "Invalid email or password" → reveals nothing
**Better:** Separate messages:
- Unverified: "Please verify your email" (implies account exists)
- Not found: "Email not found" (tells them to register)

**Why okay to differentiate?**
- Doesn't leak additional info (just says "account exists but unverified" vs "no account")
- Better UX: guides user to correct action
- Not a security risk: attacker already knows email is valid if they own it

### 3. Token Security
- SHA1 hashing of email in URL ( Laravel standard )
- HMAC signature prevents URL tampering
- Expiry timestamp prevents indefinite validity

### 4. Session Security
- `pending_verification_email` stored in session (secure, server-side)
- Flash messages used instead of persistent state

---

## 📁 File Structure & Responsibilities

```
app/
├── Services/
│   └── AuthService.php              # Business logic layer
├── Livewire/
│   └── Auth/
│       ├── LoginForm.php            # Login UI + state
│       └── VerifyEmailNotice.php   # Verification UI + state
├── Models/
│   └── User.php                    # HasVerifiedEmail() method
├── Notifications/
│   └── VerifyEmailNotification.php # Email template + expiry
└── Http/
    └── Controllers/
        └── AuthController.php       # Only handles logout

resources/
└── views/
    └── livewire/auth/
        ├── login-form.blade.php     # Login form UI
        └── verify-email-notice.blade.php # Resend page

routes/
└── web.php                         # Verification route + expiry check
```

**Responsibility Matrix:**

| Component | Responsibility |
|-----------|----------------|
| `VerifyEmailNotification` | Generate signed URL with 60-min expiry |
| `User::hasVerifiedEmail()` | Check email_verified_at |
| `AuthService::resendVerification()` | Send new verification email |
| `LoginForm` | Handle login attempt logic, UI state |
| `VerifyEmailNotice` | Handle resend request from notice page |
| `web.php` route | Check signature expiry, verify user |
| Blade views | Display messages, buttons, links |

---

## 🧪 Testing Scenarios

### Scenario 1: New User Registration
```
1. User registers → User created with email_verified_at = null
2. Notification sent with 60-min signed URL
3. Redirected to verification.notice
4. Email arrives → user clicks link within 60 mins
5. Route checks signature → valid → verified → redirected to login
✓ SUCCESS
```

### Scenario 2: Expired Link
```
1. User registers but doesn't click link for 2 hours
2. Clicks old email link
3. Route: hasValidSignature() = false
4. Redirected to verification.notice with error
5. User sees "Your verification link has expired"
6. Clicks "Resend verification email"
7. New email with fresh 60-min link sent
✓ SUCCESS
```

### Scenario 3: Login Unverified
```
1. User tries to login with unverified email
2. LoginForm checks: email_verified_at = null
3. Shows error: "Please verify your email"
4. Shows "Resend verification email" button
5. User clicks resend → new email sent
✓ SUCCESS
```

### Scenario 4: Email Not Registered
```
1. User types random email on login
2. LoginForm: User::where('email') → null
3. Shows: "This email has not been used..."
4. Shows "Create an account" link
✓ SUCCESS
```

### Scenario 5: Resend Already Verified
```
1. User clicks resend after already verifying
2. resendVerification() checks hasVerifiedEmail()
3. Shows: "This email is already verified"
✓ SUCCESS
```

---

## 🔧 Configuration

### Extend Verification Expiry

**File:** `app/Notifications/VerifyEmailNotification.php:20`

```php
// Default: 60 minutes
now()->addMinutes(60);

// Change to 24 hours:
now()->addHours(24);

// Change to 3 days:
now()->addDays(3);
```

### Customize Verification Routes

**File:** `routes/web.php:56-58`

```php
// Both routes point to same Livewire component
Route::get('/email/verify', VerifyEmailNotice::class)->name('verification.notice');
Route::get('/verification-required', VerifyEmailNotice::class)->name('verification.required');
```

Used by:
- `verified` middleware (auto-redirects unverified users)
- Manual redirects in code

---

## 📊 Database Schema

```sql
users table:
- id
- name
- email
- password
- email_verified_at (TIMESTAMP NULLABLE) ← KEY FIELD
- remember_token
- created_at
- updated_at

email_verified_at = NULL → unverified
email_verified_at = timestamp → verified
```

**Laravel helper methods:**
- `$user->hasVerifiedEmail()` → checks null
- `$user->markEmailAsVerified()` → sets timestamp
- `$user->getEmailForVerification()` → returns email

---

## 🐛 Common Pitfalls & Solutions

### Pitfall 1: Resend button shows for wrong emails
**Solution:** Add `$emailNotFound` flag, hide resend button when true (LoginForm.php:21)

### Pitfall 2: Expired link shows generic error
**Solution:** Check `request()->hasValidSignature()` before verifying (web.php:43)

### Pitfall 3: User can spam resend
**Solution:** Laravel's built-in throttle middleware on `verification.verify` route

### Pitfall 4: Session state persists across users
**Solution:** Forget session on successful verify: `session()->forget('pending_verification_email')`

### Pitfall 5: Resend after clicking link but before verification
**Solution:** Check `hasVerifiedEmail()` before sending, show appropriate message (LoginForm.php:81)

---

## 🎓 Key Takeaways

1. **Separate concerns:** AuthService handles business logic, Livewire handles UI state, routes handle HTTP flow.

2. **Early returns:** Check conditions in order: exists → verified → password → login. Prevent complex nested ifs.

3. **User guidance:** Every error state provides a clear next action (register, resend, login).

4. **Security built-in:** Laravel's signed URLs, rate limiting, and hashing are free—just use them.

5. **Session for fallback:** `pending_verification_email` allows resend page to work even if user didn't come through login.

6. **Graceful degradation:** Every edge case (not found, already verified, expired) has a user-friendly path.

7. **State management:** Livewire public properties = UI state. Use boolean flags for visibility toggles.

---

## 🔄 Production Enhancements (Optional)

1. **Queue resend emails** → `VerifyEmailNotification` implements `ShouldQueue`
2. **Throttle resend** → custom middleware on resend route
3. **Admin verification** → allow admins to verify users manually in dashboard
4. **Email change flow** → handle user changing email before verification
5. **Logging** → log verification attempts for security monitoring
6. **Metrics** → track resend rates, expiry rates to adjust timeout

---

## ✅ Implementation Checklist

- [x] AuthService::resendVerification() method
- [x] LoginForm: detect unverified + show resend button
- [x] LoginForm: detect non-existent + show register link
- [x] LoginForm: resendVerification() action
- [x] VerifyEmailNotice: use AuthService (not direct notify)
- [x] verify route: check request()->hasValidSignature()
- [x] Views: show appropriate error/success messages
- [x] Views: include resend button where applicable
- [x] Validate all inputs consistently
- [x] Test all 5 scenarios above

---

**Total Changes:** 6 files modified | ~200 lines changed | ~1 hour implementation
