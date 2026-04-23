<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name', 'Akura') }}</title>
    <meta name="description" content="{{ $description ?? 'Secure account management with email verification and password recovery' }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html { scroll-behavior: smooth; }
        .gradient-text {
            background: linear-gradient(135deg, #34d399 0%, #10b981 50%, #0d9488 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-950 text-white antialiased">
    <!-- Navigation -->
    <nav class="border-b border-gray-800 bg-gray-900/80 backdrop-blur-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="text-xl font-bold gradient-text">
                        Akura Monitoring
                    </a>
                </div>
                
                <!-- Nav Links -->
                <div class="flex items-center gap-4">
                    @auth   
                        <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-white transition text-sm font-medium">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-300 hover:text-white transition text-sm font-medium">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition text-sm font-medium">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg hover:from-green-600 hover:to-emerald-700 transition shadow-lg shadow-green-500/25 text-sm font-semibold">
                            Get Started
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content - FULL WIDTH for landing -->
    <main>
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-800 py-8 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-500 text-sm">
                © {{ date('Y') }} {{ config('app.name', 'Akura') }}. All rights reserved.
            </p>
        </div>
    </footer>
</body>
</html>
