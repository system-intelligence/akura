<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $rememberStatus = 'Inactive';

    public function mount()
    {
        $this->loadRememberStatus();
    }

    public function loadRememberStatus()
    {
        $user = Auth::user();
        $this->rememberStatus = $user && $user->remember_token ? 'Active' : 'Inactive';
    }

    public function render()
    {
        return view('dashboard');
    }
}
