<?php

namespace App\Livewire\Auth;

use App\Services\AuthService;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.auth')]
class RegisterForm extends Component
{
    public $name;

    public $email;

    public $password;

    public $password_confirmation;

    public $isLoading = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ];

    public function register(AuthService $authService)
    {
        $this->isLoading = true;
        $this->validate();

        $authService->register([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        session()->flash('success', 'Registration successful! Please check your email to verify your account.');

        return redirect()->route('verification.notice');
    }

    public function render()
    {
        return view('livewire.auth.register-form');
    }
}
