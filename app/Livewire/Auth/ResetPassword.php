<?php

namespace App\Livewire\Auth;

use App\Services\AuthService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.auth')]
class ResetPassword extends Component
{
    public $token;

    public $email = '';

    public $password = '';

    public $passwordConfirmation = '';

    public $resetSuccess = false;

    public $invalidToken = false;

    public $isLoading = false;

    protected function rules(): array
    {
        return [
            'token' => 'required|string',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8',
            'passwordConfirmation' => 'required|string|same:password',
        ];
    }

    protected function messages(): array
    {
        return [
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'email.exists' => 'No account found with this email.',
            'password.required' => 'Please enter your password.',
            'password.min' => 'Password must be at least 8 characters.',
            'passwordConfirmation.required' => 'Please confirm your password.',
            'passwordConfirmation.same' => 'Passwords do not match.',
        ];
    }

    public function mount(string $token)
    {
        $this->token = $token;

        $this->email = request()->query('email');

        if (! $this->email) {
            $this->invalidToken = true;

            return;
        }

        $reset = DB::table('password_reset_tokens')
            ->where('email', $this->email)
            ->first();

        if (! $reset) {
            $this->invalidToken = true;

            return;
        }

        if (! Hash::check($this->token, $reset->token)) {
            $this->invalidToken = true;

            return;
        }

        if (! request()->hasValidSignature()) {
            $this->invalidToken = true;

            return;
        }
    }

    public function resetPassword(AuthService $authService)
    {
        if ($this->invalidToken) {
            return;
        }

        $this->isLoading = true;
        $this->validate();

        $reset = DB::table('password_reset_tokens')
            ->where('email', $this->email)
            ->first();

        if (! $reset || ! Hash::check($this->token, $reset->token)) {
            $this->invalidToken = true;
            $this->isLoading = false;

            return;
        }

        $success = $authService->resetPassword(
            $this->email,
            $this->password
        );

        if ($success) {
            DB::table('password_reset_tokens')
                ->where('email', $this->email)
                ->delete();

            $this->resetSuccess = true;
            $this->reset(['token', 'email', 'password', 'passwordConfirmation']);
        } else {
            $this->addError('password', 'Unable to reset password. Please try again.');
        }

        $this->isLoading = false;
    }

    public function render()
    {
        return view('livewire.auth.reset-password');
    }
}
