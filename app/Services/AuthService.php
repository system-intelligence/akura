<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        return $user;
    }

    public function login(array $credentials, bool $remember = false): bool
    {
        if (! Auth::attempt($credentials, $remember)) {
            return false;
        }

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
}
