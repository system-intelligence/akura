# Akura v4 - Developer Quick Reference

**Last Updated:** April 23, 2026 | **Status:** ✅ Production Ready

---

## 🚀 Quick Start

### Running the Application
```bash
# Install dependencies
composer install
npm install

# Start development server
php artisan serve

# Build assets (watch mode)
npm run dev

# Production build
npm run build
```

### After Making Changes
```bash
# If you modify blade templates
php artisan view:clear

# If you modify components
php artisan cache:clear
npm run build

# Full cache clear
php artisan cache:clear && php artisan config:clear
```

---

## 📦 Component Cheat Sheet

### Form Input
```blade
<x-input 
    name="fieldname"
    type="email|text|password|number|date"
    label="Field Label"
    placeholder="Placeholder text"
    model="wireModel"
    class="extra-classes"
/>
```

**What it does:**
- ✅ Renders labeled input with Tailwind styling
- ✅ Automatically displays validation errors
- ✅ Supports wire:model binding
- ✅ Loading state handling

### Alert/Flash Messages
```blade
<!-- Success alert -->
<x-alert type="success" message="Action completed!" />
<x-alert type="success" :message="session('status')" />

<!-- Error alert -->
<x-alert type="error" message="Something went wrong" />

<!-- Info alert -->
<x-alert type="info">Custom message in slot</x-alert>
```

### Checkbox
```blade
<x-checkbox 
    name="remember"
    label="Remember me"
    model="remember"
/>
```

### Button
```blade
<x-button type="submit" variant="primary" class="w-full">
    Click Me
</x-button>

<!-- Variants: primary, secondary, danger -->
```

### Card
```blade
<x-card title="Card Title" class="optional-classes">
    Your content here
</x-card>
```

### Icon
```blade
<x-icon name="check" class="w-5 h-5" />
<x-icon name="error" />
<x-icon name="user" />
<!-- More: lock, arrow-right, chart, info -->
```

---

## 🎯 Common Tasks

### Add a New Form Field
1. Open your `.blade.php` file
2. Add the component:
```blade
<x-input 
    name="fieldname"
    type="text"
    label="Field Label"
    placeholder="hint text"
    model="livewireProperty"
/>
```
3. Add property in Livewire component:
```php
public $fieldname = '';
```
4. Add validation rule:
```php
protected function rules(): array
{
    return [
        'fieldname' => 'required|string',
    ];
}
```

### Add a New Livewire Auth Form
1. Create component in `app/Livewire/Auth/FormName.php`:
```php
<?php
namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.auth')]
class FormName extends Component
{
    public $fieldname = '';
    
    protected function rules(): array
    {
        return ['fieldname' => 'required'];
    }
    
    public function submit()
    {
        $this->validate();
        // Your logic here
    }
    
    public function render()
    {
        return view('livewire.auth.form-name');
    }
}
```

2. Create view in `resources/views/livewire/auth/form-name.blade.php`:
```blade
<x-card title="Form Title">
    <form wire:submit.prevent="submit" class="space-y-5">
        @csrf
        
        <x-input name="fieldname" label="Field Label" model="fieldname" />
        
        <x-button type="submit" variant="primary" class="w-full">
            Submit
        </x-button>
    </form>
</x-card>
```

3. Add route in `routes/web.php`:
```php
Route::get('/form-route', FormName::class)->name('form.route');
```

### Update Component Styling
1. Edit component in `resources/views/components/component-name.blade.php`
2. Modify Tailwind classes
3. Run: `npm run build`
4. Test in browser

### Fix Layout Issues
1. For auth pages: Edit `resources/views/layouts/auth.blade.php`
2. For landing pages: Edit `resources/views/layouts/landing.blade.php`
3. For dashboard: Edit `resources/views/layouts/app.blade.php`

---

## 🧪 Testing Components

### Test if Component Works
```blade
<!-- Test component in a blade view -->
<x-input name="test" label="Test" />

<!-- Should render input with label and error support -->
```

### Livewire Component Test
```php
test('login form submits correctly', function () {
    $this->livewire(LoginForm::class)
        ->set('email', 'test@example.com')
        ->set('password', 'password123')
        ->call('login')
        ->assertRedirect('/dashboard');
});
```

---

## 🐛 Troubleshooting

### Component Not Showing
```
Problem: <x-input /> is not rendering
Solution: 
  1. Check filename is correct (input.blade.php)
  2. Run: php artisan view:clear
  3. Check @props directive at top of component
  4. Verify component location: resources/views/components/
```

### Styling Not Applied
```
Problem: Component styling looks wrong
Solution:
  1. Run: npm run build
  2. Hard refresh browser (Ctrl+Shift+R)
  3. Check class names in component file
  4. Verify Tailwind is configured correctly
```

### Validation Not Showing
```
Problem: Error messages not appearing
Solution:
  1. Add @error('fieldname') check
  2. Component automatically handles this
  3. Ensure wire:model is set correctly
  4. Check validation rules method in component
```

### Livewire Component Not Showing
```
Problem: Livewire component page is blank
Solution:
  1. Check #[Layout('layouts.auth')] is present
  2. Run: php artisan cache:clear
  3. Verify blade view file exists
  4. Check render() method returns correct view
```

---

## 📂 File Locations Reference

```
Component Files:
  └─ resources/views/components/

Livewire Components:
  └─ app/Livewire/
     ├─ Auth/
     │  ├─ LoginForm.php
     │  ├─ RegisterForm.php
     │  └─ ... other auth components
     └─ Dashboard.php

Views:
  └─ resources/views/
     ├─ layouts/
     │  ├─ auth.blade.php
     │  ├─ landing.blade.php
     │  └─ app.blade.php
     ├─ livewire/
     │  ├─ auth/
     │  │  ├─ login-form.blade.php
     │  │  ├─ register-form.blade.php
     │  │  └─ ...
     │  └─ dashboard.blade.php
     └─ components/ (reusable components)

Configuration:
  └─ config/
     ├─ app.php
     ├─ auth.php
     ├─ mail.php
     └─ ...

Routes:
  └─ routes/
     ├─ web.php (main routes)
     └─ console.php
```

---

## 🎨 Color Scheme

**Primary Colors:**
- Primary: `green-500`, `green-600`
- Accent: `emerald-500`, `emerald-600`
- Success: `green-400`, `green-500`
- Error: `red-400`, `red-500`
- Warning: `yellow-400`

**Background Colors:**
- Dark bg: `gray-900`, `gray-800`
- Lighter: `gray-700`
- Surface: `gray-800/50`
- Border: `gray-700`

**Text Colors:**
- Primary text: `white`
- Secondary: `gray-300`
- Muted: `gray-400`
- Error: `red-400`
- Success: `green-400`

---

## 🔑 Common Git Commands

```bash
# Check status
git status

# Create new branch for feature
git checkout -b feature/feature-name

# Stage changes
git add .

# Commit changes
git commit -m "feat: description of change"

# Push to remote
git push origin feature/feature-name

# View logs
git log --oneline
```

---

## 🔗 Useful Commands

```bash
# Clear all Laravel caches
php artisan cache:clear && php artisan config:clear && php artisan view:clear

# Run tests
php artisan test

# Generate new controller
php artisan make:controller ControllerName

# Generate new Livewire component
php artisan livewire:make ComponentName

# Database migration
php artisan migrate

# Seed database
php artisan db:seed
```

---

## 📚 Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Livewire Documentation](https://livewire.laravel.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Blade Documentation](https://laravel.com/docs/blade)

---

## ✅ Pre-Deployment Checklist

- [ ] All tests passing: `php artisan test`
- [ ] No console errors in browser
- [ ] Forms working correctly
- [ ] Responsive on mobile
- [ ] Email verification working
- [ ] Password reset working
- [ ] Environmental variables set correctly
- [ ] Database migrations up to date
- [ ] CSS/JS built: `npm run build`

---

## 💡 Pro Tips

1. **Use Livewire's `wire:loading` directive:**
   ```blade
   <button wire:loading.attr="disabled">
       <span wire:loading.remove>Submit</span>
       <span wire:loading>Processing...</span>
   </button>
   ```

2. **Use browser dev tools:** F12 → Inspect element to see generated HTML

3. **Watch mode during development:**
   ```bash
   npm run dev  # CSS/JS rebuilds automatically
   ```

4. **Test email locally:** Configure `MAIL_DRIVER=log` in `.env`

5. **Use Laravel Tinker:** `php artisan tinker` for quick database testing

---

**Need Help?** Check BEST_PRACTICES_GUIDE.md for detailed information!
