<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VerifyEmailNotice extends Component
{
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function resend()
    {
        if (! $this->user) {
            $email = session('pending_verification_email');
            $user = User::where('email', $email)->first();
        } else {
            $user = $this->user;
        }

        if (! $user || $user->hasVerifiedEmail()) {
            return redirect()->route('login');
        }

        $user->notify(new VerifyEmailNotification);

        session()->flash('status', 'Verification link sent!');
    }

    public function render()
    {
        return view('livewire.auth.verify-email-notice');
    }
}
