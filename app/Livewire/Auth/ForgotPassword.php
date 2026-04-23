<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Services\AuthService;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.auth')]
class ForgotPassword extends Component
{
    public $email = '';

    public $emailSent = false;

    public $emailNotFound = false;

    public $notVerified = false;

    public $isLoading = false;

    protected function rules(): array
    {
        return [
            'email' => 'required|email',
        ];
    }

    protected function messages(): array
    {
        return [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
        ];
    }

    public function sendResetLink(AuthService $authService)
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

        if (! $user->hasVerifiedEmail()) {
            $this->notVerified = true;
            $this->addError('email', 'Please verify your email before requesting a password reset.');
            $this->isLoading = false;

            return;
        }

        $success = $authService->sendPasswordResetLink($this->email);

        if ($success) {
            $this->emailSent = true;
            $this->resetErrorBag('email');
        } else {
            $this->addError('email', 'Unable to send reset link. Please try again.');
        }

        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
