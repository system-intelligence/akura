<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Services\AuthService;
use Livewire\Component;

class LoginForm extends Component
{
    public $email = '';

    public $password = '';

    public $remember = false;

    public $rememberDebug = 'unchecked';

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

    public function login(AuthService $authService)
    {
        $this->validate();

        $user = User::where('email', $this->email)->first();

        if (! $user) {
            $this->addError('email', 'Invalid credentials.');

            return;
        }

        if ($user->email_verified_at === null) {
            session()->put('pending_verification_email', $user->email);
            $this->addError('email', 'Please verify your email first.');

            return;
        }

        if ($authService->login([
            'email' => $this->email,
            'password' => $this->password,
        ], $this->remember)) {
            session()->regenerate();

            return redirect()->route('dashboard');
        }

        $this->addError('email', 'Invalid credentials.');
    }

    public function render()
    {
        return view('livewire.auth.login-form');
    }
}
