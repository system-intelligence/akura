<?php

namespace App\Services;

use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\VerifyEmailNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthService
{
    public function register(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->notify(new VerifyEmailNotification);

        session()->put('pending_verification_email', $user->email);
        Auth::logout();

        return $user;
    }

    public function login(array $credentials, bool $remember = false): bool
    {
        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            return false;
        }

        Auth::login($user, $remember);

        if (! $remember) {
            Auth::user()->remember_token = null;
            Auth::user()->save();
        }

        return true;
    }

    public function logout(): void
    {
        $user = Auth::user();
        if ($user) {
            $user->remember_token = null;
            $user->save();
        }

        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
    }

    public function resendVerification(User $user): void
    {
        if (! $user->hasVerifiedEmail()) {
            $user->notify(new VerifyEmailNotification);
        }
    }

    public function sendPasswordResetLink(string $email): bool
    {
        $user = User::where('email', $email)->first();

        if (! $user) {
            return false;
        }

        if (! $user->hasVerifiedEmail()) {
            return false;
        }

        $token = Str::random(60);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'email' => $email,
                'token' => Hash::make($token),
                'created_at' => now(),
            ]
        );

        $user->notify(new ResetPasswordNotification($token));

        return true;
    }

    public function resetPassword(string $email, string $password): bool
    {
        $user = User::where('email', $email)->first();

        if (! $user) {
            return false;
        }

        $user->password = Hash::make($password);
        $user->save();

        return true;
    }
}
