<?php

namespace App\Livewire\Auth;

use App\Services\AuthService;
use Livewire\Component;

class LogoutButton extends Component
{
    public function logout(AuthService $authService)
    {
        $authService->logout();

        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.logout-button');
    }
}
