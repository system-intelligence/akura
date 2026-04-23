<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Services\AuthService;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.auth')]
class LoginForm extends Component
{
    public $email = '';

    public $password = '';

    public $remember = false;

    public $rememberDebug = 'unchecked';

    public $showResendLink = false;

    public $resendEmail = '';

    public $emailNotFound = false;

    public $isLoading = false;

    protected $messages = [
        'email.required' => 'Please enter your email address.',
        'email.email' => 'Please enter a valid email address.',
        'password.required' => 'Please enter your password.',
    ];

    protected function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required',
        ];
    }

    public function updatedRemember()
    {
        $this->rememberDebug = $this->remember ? 'checked' : 'unchecked';
    }

    public function updatedEmail()
    {
        $this->emailNotFound = false;
        $this->showResendLink = false;
        $this->resetErrorBag('email');
    }

    public function login(AuthService $authService)
    {
        $this->isLoading = true;
        $this->validate();

        $user = User::where('email', $this->email)->first();

        if (! $user) {
            $this->emailNotFound = true;
            $this->addError('email', 'This email has not been used to create an account yet.');
            $this->isLoading = false;

            return;
        }

        if ($user->email_verified_at === null) {
            session()->put('pending_verification_email', $user->email);
            $this->addError('email', 'Please verify your email first.');
            $this->showResendLink = true;
            $this->resendEmail = $user->email;
            $this->emailNotFound = false;
            $this->isLoading = false;

            return;
        }

        if ($authService->login([
            'email' => $this->email,
            'password' => $this->password,
        ], $this->remember)) {
            session()->regenerate();
            $this->isLoading = false;

            return redirect()->route('dashboard');
        }

        $this->addError('email', 'Invalid credentials.');
        $this->isLoading = false;
    }

    public function resendVerification(AuthService $authService)
    {
        $this->isLoading = true;
        $this->validate(['email' => 'required|email']);

        $user = User::where('email', $this->email)->first();

        if (! $user) {
            $this->emailNotFound = true;
            $this->addError('email', 'This email has not been used to create an account yet.');
            $this->showResendLink = false;
            $this->isLoading = false;

            return;
        }

        if ($user->hasVerifiedEmail()) {
            $this->showResendLink = false;
            $this->addError('email', 'This email is already verified. You can log in.');
            $this->isLoading = false;

            return;
        }

        $authService->resendVerification($user);
        session()->flash('status', 'Verification email resent! Please check your inbox.');
        $this->showResendLink = false;
        $this->emailNotFound = false;
        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.auth.login-form');
    }
}
