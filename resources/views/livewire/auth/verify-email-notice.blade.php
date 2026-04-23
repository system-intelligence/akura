<div class="text-center space-y-6">
    {{-- Error State (Expired Link) --}}
    @if (session('error'))
        <div class="bg-red-500/20 border border-red-500/50 text-red-400 px-4 py-3 rounded-lg flex items-center mx-auto max-w-md">
            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <p class="text-sm font-medium">{{ session('error') }}</p>
        </div>
    @endif

    {{-- Success Status --}}
    @if (session('status'))
        <div class="bg-green-500/20 border border-green-500/50 text-green-400 px-4 py-3 rounded-lg flex items-center mx-auto max-w-md">
            <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-sm font-medium">{{ session('status') }}</p>
        </div>
    @endif

    {{-- Email Icon --}}
    <div class="flex justify-center py-4">
        <div class="p-4 bg-yellow-500/10 rounded-full">
            <svg class="w-12 h-12 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
        </div>
    </div>

    {{-- Email Info --}}
    @if($user)
        <div class="bg-gray-800/30 border border-gray-700/50 rounded-lg p-4 mx-auto max-w-md">
            <p class="text-gray-300">
                We've sent a verification email to
                <span class="font-semibold text-white">{{ $user->email }}</span>.
            </p>
        </div>
    @else
        <div class="bg-gray-800/30 border border-gray-700/50 rounded-lg p-4 mx-auto max-w-md">
            <p class="text-gray-300">
                We've sent a verification email to
                <span class="font-semibold text-white">{{ session('pending_verification_email') }}</span>.
            </p>
        </div>
    @endif

    <p class="text-gray-400 text-sm leading-relaxed max-w-md mx-auto">
        Please check your inbox (and spam folder) and click the verification link to activate your account.
    </p>

    {{-- Resend Button --}}
    <div class="pt-2">
        <button wire:click="resend"
            type="button"
            class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-lg shadow-green-500/25 transition disabled:opacity-50 disabled:cursor-not-allowed"
            wire:loading.attr="disabled"
            wire:target="resend"
            wire:loading.class="opacity-50 cursor-not-allowed">
            <span wire:loading-remove wire:target="resend">Resend Verification Email</span>
            <span wire:loading wire:target="resend">Sending...</span>
        </button>
    </div>

    {{-- Back to Login --}}
    <div class="pt-4">
        <a href="{{ route('login') }}" class="inline-flex items-center text-gray-400 hover:text-white text-sm font-medium transition">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Login
        </a>
    </div>
</div>
