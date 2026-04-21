<button 
    type="{{ $type ?? 'button' }}"
    {{ $attributes->class([
        'px-4 py-2.5 rounded-lg font-medium transition-all duration-200',
        'bg-gradient-to-r from-green-500 to-emerald-600 text-white hover:from-green-600 hover:to-emerald-700 shadow-lg shadow-green-500/25 hover:shadow-green-500/40' => $variant === 'primary',
        'bg-gray-800 text-white border border-gray-700 hover:bg-gray-700' => $variant === 'secondary',
        'bg-red-600 text-white hover:bg-red-700' => $variant === 'danger',
    ]) }}
>
    {{ $slot }}
</button>