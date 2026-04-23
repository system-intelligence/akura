<?php

use App\Http\Controllers\AuthController;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\LoginForm;
use App\Livewire\Auth\RegisterForm;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\VerifyEmailNotice;
use App\Livewire\Dashboard;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Landing page - redirect logged in users to dashboard
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }

    return view('landing-content');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/register', RegisterForm::class)->name('register');
    Route::get('/login', LoginForm::class)->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Password Reset Routes
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
    Route::post('/forgot-password', ForgotPassword::class)->name('password.email');
    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
    Route::post('/reset-password', ResetPassword::class)->name('password.update');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/email/verify/{id}/{hash}', function ($id, $hash) {
    $user = User::findOrFail($id);

    if (! hash_equals(sha1($user->getEmailForVerification()), $hash)) {
        abort(403);
    }

    if ($user->hasVerifiedEmail()) {
        return redirect()->route('login')->with('status', 'Email already verified!');
    }

    if (! request()->hasValidSignature()) {
        return redirect()->route('verification.notice')
            ->with('error', 'Your verification link has expired. Click below to request a new one.');
    }

    $user->email_verified_at = now();
    $user->save();

    session()->forget('pending_verification_email');

    return redirect()->route('login')->with('status', 'Email verified! You can now login.');
})->name('verification.verify');

Route::get('/email/verify', VerifyEmailNotice::class)->name('verification.notice');

Route::get('/verification-required', VerifyEmailNotice::class)->name('verification.required');
