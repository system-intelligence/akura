@props([
    'name',
    'class' => 'w-5 h-5'
])

<svg class="{{ $class }} flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    @switch($name)
        @case('check')
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        @break
        
        @case('error')
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        @break
        
        @case('info')
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        @break
        
        @case('user')
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        @break
        
        @case('lock')
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm6-10V7a3 3 0 00-3-3h-.015C9.338 4 8 5.338 8 7c0 2.211-1.697 4-3.828 4m11.656 0A4 4 0 0016 7c0-1.662-.672-3.157-1.757-4.243m2.121 10.364A6.966 6.966 0 0121 12c0-3.866-3.134-7-7-7s-7 3.134-7 7c0 1.93.784 3.765 2.05 5.364"></path>
        @break
        
        @case('arrow-right')
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
        @break
        
        @case('chart')
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 7a4 4 0 100-8 4 4 0 000 8zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        @break
        
        @default
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5v14"></path>
    @endswitch
</svg>
