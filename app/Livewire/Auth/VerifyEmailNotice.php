<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.auth')]
class VerifyEmailNotice extends Component
{
    public $user;

    public $isLoading = false;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function resend(AuthService $authService)
    {
        $this->isLoading = true;

        if (! $this->user) {
            $email = session('pending_verification_email');
            $user = User::where('email', $email)->first();
        } else {
            $user = $this->user;
        }

        if (! $user || $user->hasVerifiedEmail()) {
            return redirect()->route('login');
        }

        $authService->resendVerification($user);

        session()->flash('status', 'Verification link sent!');
        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.auth.verify-email-notice');
    }
}
