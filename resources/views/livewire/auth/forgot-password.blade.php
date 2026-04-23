<x-card title="Forgot Password">
    <div class="space-y-6">
        @if ($emailSent)
            {{-- Success State --}}
            <div class="bg-green-500/20 border border-green-500/50 text-green-400 px-4 py-3 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <p class="font-semibold">Reset link sent!</p>
                    <p class="text-sm mt-0.5 opacity-90">Check your email for instructions to reset your password.</p>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-3 pt-2">
                <button wire:click="sendResetLink" 
                    class="text-green-400 hover:text-green-300 text-sm font-medium transition"
                    wire:loading.attr="disabled"
                    wire:target="sendResetLink"
                    wire:loading.class="opacity-50 cursor-not-allowed">
                    <span wire:loading-remove wire:target="sendResetLink">Try again</span>
                    <span wire:loading wire:target="sendResetLink">Sending...</span>
                </button>

                <span class="text-gray-500 text-sm">or</span>

                <a href="{{ route('login') }}" class="text-gray-400 hover:text-white text-sm font-medium transition">
                    Back to Login
                </a>
            </div>
        @else
            {{-- Form --}}
            <form wire:submit.prevent="sendResetLink" class="space-y-5">
                @csrf

                {{-- Email Field --}}
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-300">
                        Email Address
                    </label>
                    <input type="email" 
                        wire:model="email" 
                        class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition text-white placeholder-gray-500"
                        placeholder="you@example.com"
                        wire:loading.attr="disabled">
                    @error('email')
                        <p class="text-red-400 text-sm flex items-center mt-1">
                            <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <x-button type="submit" 
                    variant="primary" 
                    class="w-full py-3 text-base font-semibold shadow-lg shadow-green-500/25"
                    wire:loading.attr="disabled" 
                    wire:target="sendResetLink"
                    wire:loading.class="opacity-50 cursor-not-allowed">
                    <span wire:loading-remove wire:target="sendResetLink">Send Reset Link</span>
                    <span wire:loading wire:target="sendResetLink">Sending...</span>
                </x-button>
            </form>

            <div class="pt-2 text-center">
                <a href="{{ route('login') }}" class="inline-flex items-center text-gray-400 hover:text-white text-sm font-medium transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Login
                </a>
            </div>
        @endif
    </div>
</x-card>
