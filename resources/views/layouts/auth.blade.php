<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name', 'Akura') }}</title>
    <meta name="description" content="{{ $description ?? 'Secure account management' }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%) !important;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .auth-container {
            width: 100%;
            max-width: 420px;
            margin: 0 auto;
        }

        .auth-container main {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="auth-container text-white antialiased">
        <!-- Logo -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="text-2xl font-bold bg-gradient-to-r from-green-400 to-emerald-500 bg-clip-text text-transparent">
                Akura Monitoring
            </a>
        </div>

        <!-- Auth Content -->
        <main>
            {{ $slot ?? '' }}
        </main>
    </div>
</body>
</html>
