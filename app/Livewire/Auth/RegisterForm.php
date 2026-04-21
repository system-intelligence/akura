<?php

namespace App\Livewire\Auth;

use App\Services\AuthService;
use Livewire\Component;

class RegisterForm extends Component
{
    public $name;

    public $email;

    public $password;

    public $password_confirmation;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ];

    public function register(AuthService $authService)
    {
        $this->validate();

        $authService->register([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.auth.register-form');
    }
}
