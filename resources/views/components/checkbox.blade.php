@props([
    'name',
    'label' => null,
    'model' => null,
    'value' => null,
])

<div class="flex items-center">
    <input 
        type="checkbox"
        id="{{ $name }}"
        name="{{ $name }}"
        @if($model)
            wire:model="{{ $model }}"
        @endif
        @if($value)
            value="{{ $value }}"
        @endif
        {{ $attributes->class([
            'rounded border-gray-600 bg-gray-800/50 text-green-500',
            'focus:ring-green-500 focus:ring-2'
        ]) }}
        wire:loading.attr="disabled"
    />
    
    @if($label)
        <label for="{{ $name }}" class="ml-2 text-sm text-gray-300 cursor-pointer">
            {{ $label }}
        </label>
    @endif
</div>
