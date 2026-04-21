<x-card title="Welcome back">
    <form wire:submit.prevent="login" class="space-y-5">
        @csrf
        
        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1">Email</label>
            <input type="email" wire:model="email" 
                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:border-green-500 focus:ring-1 focus:ring-green-500 text-white placeholder-gray-500 transition"
                placeholder="Enter your email">
            @error('email') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1">Password</label>
            <input type="password" wire:model="password" 
                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:border-green-500 focus:ring-1 focus:ring-green-500 text-white placeholder-gray-500 transition"
                placeholder="Enter your password">
            @error('password') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center">
            <input type="checkbox" wire:model="remember" wire:change="$refresh" class="rounded border-gray-600 bg-gray-800 text-green-500 focus:ring-green-500">
            <label class="ml-2 text-sm text-gray-400">Remember me</label>
            <span class="ml-2 text-xs text-gray-500">(debug: {{ $remember ? 'checked' : 'unchecked' }})</span>
        </div>

        <x-button type="submit" variant="primary" class="w-full py-3">
            Sign In
        </x-button>
        
        <p class="text-center text-gray-500 text-sm">
            Don't have an account? 
            <a href="{{ route('register') }}" class="text-green-400 hover:text-green-300">Register</a>
        </p>
    </form>
</x-card>