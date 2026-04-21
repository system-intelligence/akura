<x-card title="Create account">
    <form wire:submit.prevent="register" class="space-y-5">
        @csrf
        
        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1">Name</label>
            <input type="text" wire:model="name" 
                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:border-green-500 focus:ring-1 focus:ring-green-500 text-white placeholder-gray-500 transition"
                placeholder="Enter your name">
            @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

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
                placeholder="Min 8 characters">
            @error('password') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-400 mb-1">Confirm Password</label>
            <input type="password" wire:model="password_confirmation" 
                class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:border-green-500 focus:ring-1 focus:ring-green-500 text-white placeholder-gray-500 transition"
                placeholder="Confirm your password">
        </div>

        <x-button type="submit" variant="primary" class="w-full py-3">
            Create Account
        </x-button>
        
        <p class="text-center text-gray-500 text-sm">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-green-400 hover:text-green-300">Login</a>
        </p>
    </form>
</x-card>