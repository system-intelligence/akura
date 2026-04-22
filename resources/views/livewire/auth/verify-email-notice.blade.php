<x-card title="Verify Your Email">
    <div class="text-center space-y-4">
        @if (session('error'))
            <div class="bg-red-500/20 text-red-400 p-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif
        
        <div class="flex justify-center">
            <svg class="w-16 h-16 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
        </div>
        
        @if($user)
            <p class="text-gray-300">
                We've sent a verification email to <strong>{{ $user->email }}</strong>. Please check your inbox and click the verification link to activate your account.
            </p>
        @else
            <p class="text-gray-300">
                We've sent a verification email to <strong>{{ session('pending_verification_email') }}</strong>. Please check your inbox and click the verification link to activate your account.
            </p>
        @endif
        
        @if (session('status'))
            <p class="text-green-400 text-sm">{{ session('status') }}</p>
        @endif
        
        <p class="text-gray-400 text-sm">
            Didn't receive the email? 
            <button wire:click="resend" type="button" class="text-green-400 hover:text-green-300 underline">
                click here to request another
            </button>
        </p>
        
        <div class="pt-4">
            <a href="{{ route('login') }}" class="text-gray-400 hover:text-white">
                Back to Login
            </a>
        </div>
    </div>
</x-card>