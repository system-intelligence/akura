<div class="w-full max-w-4xl mx-auto flex flex-col items-center justify-center min-h-[60vh] text-center">
    <div class="mb-6 p-4 rounded-full bg-gradient-to-br from-green-500/20 to-emerald-500/20">
        <svg class="w-16 h-16 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </div>

    <h1 class="text-3xl font-bold mb-2">
        Welcome back, <span class="text-green-400">{{ auth()->user()->name }}</span>
    </h1>

    <p class="text-gray-400 mb-8">
        You're logged in to {{ config('app.name', 'Akura') }}
    </p>

    <x-card class="text-left w-full max-w-md">
        <div class="flex items-center gap-4">
            <div class="p-3 rounded-lg bg-green-500/20">
                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
            <div>
                <p class="text-white font-medium">Your account is secure</p>
                <p class="text-sm text-gray-400">All data is protected</p>
            </div>
        </div>
    </x-card>

    <div class="mt-4">
        <p class="text-sm text-gray-400">
            Remember Me Status: 
            <span class="ml-4 text-sm {{ $rememberStatus === 'Active' ? 'text-green-500' : 'text-red-500' }}">
                {{ $rememberStatus }}
            </span>
        </p>
    </div>
</div>  