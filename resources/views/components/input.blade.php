@props([
    'name',
    'type' => 'text',
    'label' => null,
    'placeholder' => null,
    'value' => null,
    'model' => null,
])

<div class="space-y-2">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-300">
            {{ $label }}
        </label>
    @endif
    
    <input 
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        @if($model)
            wire:model="{{ $model }}"
        @endif
        {{ $attributes->class([
            'w-full px-4 py-3 bg-gray-800/50 border border-gray-700 rounded-lg',
            'focus:border-green-500 focus:ring-2 focus:ring-green-500/20 focus:outline-none',
            'transition text-white placeholder-gray-500'
        ]) }}
        @if($placeholder) placeholder="{{ $placeholder }}" @endif
        @if($value) value="{{ $value }}" @endif
        wire:loading.attr="disabled"
    />
    
    @error($name)
        <x-error-message :message="$message" />
    @enderror
</div>
