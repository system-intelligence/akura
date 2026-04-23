@props(['message' => ''])

<p class="text-red-400 text-sm flex items-center mt-1">
    <x-icon name="error" class="w-4 h-4 mr-1 flex-shrink-0" />
    {{ $message ?? $slot }}
    {{ $slot }}
</p>
