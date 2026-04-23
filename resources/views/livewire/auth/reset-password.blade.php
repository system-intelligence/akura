<x-card title="Reset Password">
    <div class="space-y-6">
        @if ($resetSuccess)
            {{-- Success State --}}
            <div class="bg-green-500/20 border border-green-500/50 text-green-400 px-4 py-4 rounded-lg flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="font-semibold text-lg">Password reset successful!</h3>
                    <p class="text-sm mt-1 opacity-90">You can now log in with your new password.</p>
                </div>
            </div>

            <div class="pt-2">
                <a href="{{ route('login') }}" class="w-full inline-flex items-center justify-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-lg shadow-green-500/25 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Go to Login
                </a>
            </div>
        @elseif ($invalidToken)
            {{-- Invalid Token State --}}
            <div class="bg-red-500/20 border border-red-500/50 text-red-400 px-4 py-4 rounded-lg flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="font-semibold text-lg">Invalid or expired reset link</h3>
                    <p class="text-sm mt-1 opacity-90">This password reset link is invalid or has expired. Please request a new one.</p>
                </div>
            </div>

            <div class="pt-2 text-center">
                <a href="{{ route('password.request') }}" class="inline-flex items-center text-green-400 hover:text-green-300 text-sm font-medium transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Request new reset link
                </a>
            </div>
        @else
            {{-- Form State --}}
            <div class="space-y-6">
                {{-- Info Banner --}}
                <div class="bg-blue-500/10 border border-blue-500/30 text-blue-300 px-4 py-3 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-sm">Enter your new password below. Make sure it's strong and secure.</p>
                    </div>
                </div>

                <form wire:submit.prevent="resetPassword" class="space-y-5">
                    @csrf

                    {{-- Email (Readonly) --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-300">
                            Email Address
                        </label>
                        <input type="email" 
                            wire:model="email" 
                            readonly
                            class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-gray-400 cursor-not-allowed"
                            placeholder="Your email">
                        <p class="text-xs text-gray-500 flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Email is prefilled from your reset link
                        </p>
                    </div>

                    {{-- Password Field --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-300">
                            New Password
                        </label>
                        <input type="password" 
                            wire:model="password" 
                            class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition text-white placeholder-gray-500"
                            placeholder="Enter new password">
                        @error('password')
                            <p class="text-red-400 text-sm flex items-center mt-1">
                                <svg class="w-4 h-4 mr-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Confirm Password Field --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-300">
                            Confirm New Password
                        </label>
                        <input type="password" 
                            wire:model="passwordConfirmation" 
                            class="w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none transition text-white placeholder-gray-500"
                            placeholder="Confirm new password">
                        @error('passwordConfirmation')
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
                        wire:target="resetPassword"
                        wire:loading.class="opacity-50 cursor-not-allowed">
                        <span wire:loading-remove wire:target="resetPassword">Reset Password</span>
                        <span wire:loading wire:target="resetPassword">Resetting...</span>
                    </x-button>
                </form>
            </div>
        @endif
    </div>
</x-card>
