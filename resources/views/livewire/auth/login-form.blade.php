<x-card title="Welcome back">
    {{-- Flash Messages --}}
    @if (session('status'))
        <x-alert type="success" :message="session('status')" class="mb-4" />
    @endif

    @if (session('error'))
        <x-alert type="error" :message="session('error')" class="mb-4" />
    @endif

    <form wire:submit.prevent="login" class="space-y-5">
        @csrf

        {{-- Email Field --}}
        <x-input 
            name="email" 
            type="email"
            label="Email Address"
            placeholder="you@example.com"
            model="email"
        />

        {{-- Password Field --}}
        <x-input 
            name="password" 
            type="password"
            label="Password"
            placeholder="Enter your password"
            model="password"
        />

        {{-- Remember Me --}}
        <x-checkbox 
            name="remember"
            label="Remember me"
            model="remember"
        />

        {{-- Submit Button --}}
        <x-button type="submit" 
            variant="primary" 
            class="w-full py-3 text-base font-semibold shadow-lg shadow-green-500/25"
            wire:loading.attr="disabled" 
            wire:target="login"
            wire:loading.class="opacity-50 cursor-not-allowed">
            <span wire:loading.remove wire:target="login">Sign In</span>
            <span wire:loading wire:target="login">Signing in...</span>
        </x-button>

        {{-- Forgot Password Link --}}
        <div class="text-center pt-2">
            <a href="{{ route('password.request') }}" class="text-sm text-gray-400 hover:text-green-400 font-medium transition">
                Forgot your password?
            </a>
        </div>

        {{-- Register Link --}}
        <div class="text-center pt-2 border-t border-gray-700/50">
            <p class="text-sm text-gray-400">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-green-400 hover:text-green-300 font-semibold transition">
                    Create one
                </a>
            </p>
        </div>
    </form>
</x-card>
