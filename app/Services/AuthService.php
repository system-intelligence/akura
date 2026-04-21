<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

        Auth::login($user);

        return $user;
    }

    public function login(array $credentials, bool $remember = false): bool
    {
        $user = User::where('email', $credentials['email'])->first();

        if (! $user) {
            return false;
        }

        if (! Hash::check($credentials['password'], $user->password)) {
            return false;
        }

        if ($remember) {
            $user->setRememberToken(Str::random(60));
            $user->save();
            Auth::login($user, true);
        } else {
            $user->remember_token = null;
            $user->save();
            Auth::login($user);
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
