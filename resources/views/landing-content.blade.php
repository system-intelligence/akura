@extends('layouts.app')

@section('content')
<div class="w-full max-w-4xl mx-auto flex flex-col items-center justify-center min-h-[60vh] text-center">
    <div class="mb-6 p-4 rounded-full bg-gradient-to-br from-green-500/20 to-emerald-500/20">
        <svg class="w-16 h-16 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
        </svg>
    </div>
    
    <h1 class="text-4xl sm:text-5xl font-bold mb-4">
        Welcome to <span class="bg-gradient-to-r from-green-400 to-emerald-500 bg-clip-text text-transparent">{{ config('app.name', 'Akura') }}</span>
    </h1>
    
    <p class="text-gray-400 text-lg mb-8 max-w-md">
        Your secure platform for managing your accounts with ease and elegance.
    </p>

    <div class="flex gap-4">
        <a href="{{ route('register') }}" class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg hover:from-green-600 hover:to-emerald-700 transition shadow-lg shadow-green-500/25">
            Get Started
        </a>
        <a href="{{ route('login') }}" class="px-6 py-3 bg-gray-800 text-white rounded-lg hover:bg-gray-700 border border-gray-700 transition">
            Login
        </a>
    </div>
</div>
@endsection