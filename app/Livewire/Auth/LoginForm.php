<?php

namespace App\Livewire\Auth;

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

        logger('Login attempt - remember value:', ['remember' => $this->remember]);

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
