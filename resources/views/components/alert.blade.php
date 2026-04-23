@props([
    'type' => 'success',
    'message' => ''
])

<div {{ $attributes->class([
    'mb-4 px-4 py-3 rounded-lg flex items-center border',
    'bg-green-500/20 border-green-500/50 text-green-400' => $type === 'success',
    'bg-red-500/20 border-red-500/50 text-red-400' => $type === 'error',
    'bg-blue-500/10 border-blue-500/30 text-blue-300' => $type === 'info',
]) }}>
    <x-icon 
        :name="$type === 'success' ? 'check' : ($type === 'error' ? 'error' : 'info')" 
        class="w-5 h-5 mr-3 flex-shrink-0"
    />
    <p class="text-sm font-medium">
        {{ $message ?? $slot }}
    </p>
</div>
