<x-card title="Create account">
    {{-- Success Flash Message --}}
    @if (session('success'))
        <x-alert type="success" :message="session('success')" class="mb-4" />
    @endif

    <form wire:submit.prevent="register" class="space-y-5">
        @csrf

        {{-- Name Field --}}
        <x-input 
            name="name" 
            type="text"
            label="Full Name"
            placeholder="John Doe"
            model="name"
        />

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
            placeholder="Min. 8 characters"
            model="password"
        />

        {{-- Confirm Password Field --}}
        <x-input 
            name="password_confirmation" 
            type="password"
            label="Confirm Password"
            placeholder="Confirm your password"
            model="password_confirmation"
        />

        {{-- Submit Button --}}
        <x-button type="submit" 
            variant="primary" 
            class="w-full py-3 text-base font-semibold shadow-lg shadow-green-500/25"
            wire:loading.attr="disabled" 
            wire:target="register"
            wire:loading.class="opacity-50 cursor-not-allowed">
            <span wire:loading.remove wire:target="register">Create Account</span>
            <span wire:loading wire:target="register">Creating account...</span>
        </x-button>

        {{-- Login Link --}}
        <div class="text-center pt-3 border-t border-gray-700/50">
            <p class="text-sm text-gray-400">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-green-400 hover:text-green-300 font-semibold transition">
                    Sign in
                </a>
            </p>
        </div>
    </form>
</x-card>
