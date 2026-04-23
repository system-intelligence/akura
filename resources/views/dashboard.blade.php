<div class="w-full max-w-4xl mx-auto mt-8">
    <div class="bg-gray-900 border border-gray-800 rounded-xl p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center">
                    <span class="text-white font-bold text-lg">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                </div>
                <div>
                    <h1 class="text-xl font-semibold text-white">
                        Welcome back, <span class="text-green-400">{{ substr(auth()->user()->name, 0, 7) . '...' }}</span>
                    </h1>
                    <p class="text-sm text-gray-400">Logged in to {{ config('app.name', 'Akura') }}</p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <span class="text-sm text-gray-400">Remember Me:</span>
                <span class="px-3 py-1 rounded-full text-sm font-medium {{ $rememberStatus === 'Active' ? 'bg-green-500/20 text-green-400 border border-green-500/30' : 'bg-gray-800 text-gray-400 border border-gray-700' }}">
                    {{ $rememberStatus }}
                </span>
            </div>
        </div>
        </div>
    </div>