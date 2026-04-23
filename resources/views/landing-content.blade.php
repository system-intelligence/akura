@extends('layouts.landing')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden">
    <!-- Background Effects -->
    <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-green-500/5 via-transparent to-transparent"></div>
    
    <!-- Grid Pattern Overlay -->
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#1f2937_1px,transparent_1px),linear-gradient(to_bottom,#1f2937_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_110%)]"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 items-center">
            
            {{-- Left: Content --}}
            <div class="space-y-8 text-center lg:text-left">
                {{-- Badge --}}
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-500/10 border border-green-500/20 text-green-400 text-sm font-medium">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L9 10.586l-1.293 1.293a1 1 0 01-1.414 0L5 10.586 3.707 12H7a1 1 0 110-2z" clip-rule="evenodd"/>
                    </svg>
                    Version 4.0 — Now Live
                </div>

                {{-- Heading --}}
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold leading-tight tracking-tight">
                    <span class="block text-gray-300">Welcome to</span>
                    <span class="block bg-gradient-to-r from-green-400 via-emerald-500 to-teal-500 bg-clip-text text-transparent">
                        Akura
                    </span>
                </h1>

                {{-- Subheading --}}
                <p class="text-lg md:text-xl text-gray-400 leading-relaxed max-w-xl mx-auto lg:mx-0">
                    Secure, elegant, and powerful account management. 
                    <span class="text-white font-semibold">Email verification</span> and 
                    <span class="text-white font-semibold">password recovery</span> built in.
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('register') }}" 
                       class="group relative px-8 py-4 bg-gradient-to-r from-green-500 to-emerald-600 text-white font-bold rounded-xl hover:from-green-600 hover:to-emerald-700 transition-all duration-300 shadow-xl shadow-green-500/30 hover:shadow-green-500/50 hover:scale-105 overflow-hidden">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5 transition-transform group-hover:rotate-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Create Account
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                    </a>
                    
                    <a href="{{ route('login') }}" 
                       class="group px-8 py-4 bg-gray-800/40 text-white font-bold rounded-xl hover:bg-gray-700/40 border border-gray-700 hover:border-gray-600 backdrop-blur-sm transition-all duration-300 flex items-center justify-center gap-2 hover:scale-105">
                        <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        Sign In
                    </a>
                </div>

                {{-- Feature Tags --}}
                <div class="flex flex-wrap gap-3 justify-center lg:justify-start pt-4">
                    <span class="px-4 py-2 bg-gray-800/60 border border-gray-700/60 rounded-full text-sm text-gray-300 flex items-center gap-2 backdrop-blur-sm">
                        <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Email Verification
                    </span>
                    <span class="px-4 py-2 bg-gray-800/60 border border-gray-700/60 rounded-full text-sm text-gray-300 flex items-center gap-2 backdrop-blur-sm">
                        <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Password Reset
                    </span>
                    <span class="px-4 py-2 bg-gray-800/60 border border-gray-700/60 rounded-full text-sm text-gray-300 flex items-center gap-2 backdrop-blur-sm">
                        <svg class="w-4 h-4 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Livewire Powered
                    </span>
                </div>

                {{-- Trust Indicator --}}
                <div class="flex items-center gap-4 pt-4 border-t border-gray-800/50 max-w-md mx-auto lg:mx-0">
                    <div class="flex -space-x-2">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-green-400 to-emerald-600 border-2 border-gray-900"></div>
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-400 to-teal-600 border-2 border-gray-900"></div>
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-teal-400 to-cyan-600 border-2 border-gray-900"></div>
                    </div>
                    <p class="text-sm text-gray-400">
                        <span class="text-white font-semibold">500+</span> active users trust Akura
                    </p>
                </div>
            </div>

            {{-- Right: Image Showcase --}}
            <div class="relative flex items-center justify-center">
                <!-- Glow Background -->
                <div class="absolute inset-0 bg-gradient-to-br from-green-500/15 via-emerald-500/10 to-teal-500/5 rounded-[2rem] blur-2xl"></div>
                
                <!-- Floating Card -->
                <div class="relative w-full max-w-lg">
                    <!-- Floating Badge Top -->
                    <div class="absolute -top-6 -right-6 z-10 px-4 py-2 bg-gray-900 border border-gray-700 rounded-xl shadow-2xl animate-bounce">
                        <p class="text-sm font-semibold text-green-400">✓ Verified Access</p>
                    </div>

                    <!-- Main Card -->
                    <div class="relative bg-gray-800/40 backdrop-blur-xl border border-gray-700/60 rounded-2xl shadow-2xl overflow-hidden group hover:border-green-500/60 transition-all duration-500 hover:shadow-green-500/10">
                        {{-- Image --}}
                        <div class="relative aspect-[4/3] overflow-hidden">
                            <img src="{{ asset('images/landing-img.png') }}" 
                                 alt="Akura Dashboard Interface" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            
                            {{-- Gradients Overlay --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent opacity-60"></div>
                        </div>
                        
                        {{-- Bottom Info Card --}}
                        <div class="absolute bottom-0 left-0 right-0 p-6 bg-gradient-to-t from-gray-900 via-gray-900/90 to-transparent">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-wider mb-1">Status</p>
                                    <p class="text-green-400 font-bold text-lg">System Operational</p>
                                </div>
                                <div class="flex items-center gap-2 px-3 py-1 bg-green-500/20 border border-green-500/30 rounded-full">
                                    <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                                    <span class="text-xs text-green-400 font-medium">Online</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="relative py-16 md:py-24 bg-gradient-to-b from-transparent via-gray-900/50 to-transparent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-6 md:gap-8">
                <div class="group text-center p-6 rounded-2xl bg-gray-800/30 border border-gray-700/50 hover:border-green-500/50 transition-all duration-300 hover:bg-gray-800/50">
                    <div class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-green-400 to-emerald-500 bg-clip-text text-transparent mb-2">
                        100%
                    </div>
                    <p class="text-gray-400 text-sm md:text-base">Secure Email Verification</p>
                </div>
                <div class="group text-center p-6 rounded-2xl bg-gray-800/30 border border-gray-700/50 hover:border-green-500/50 transition-all duration-300 hover:bg-gray-800/50">
                    <div class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-green-400 to-emerald-500 bg-clip-text text-transparent mb-2">
                        24/7
                    </div>
                    <p class="text-gray-400 text-sm md:text-base">Password Recovery</p>
                </div>
                <div class="group text-center p-6 rounded-2xl bg-gray-800/30 border border-gray-700/50 hover:border-green-500/50 transition-all duration-300 hover:bg-gray-800/50">
                    <div class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-green-400 to-emerald-500 bg-clip-text text-transparent mb-2">
                        Livewire
                    </div>
                    <p class="text-gray-400 text-sm md:text-base">Real-time Interactions</p>
                </div>
            </div>
        </div>
    </section>
@endsection
