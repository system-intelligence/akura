<div {{ $attributes->class(['bg-gray-900 border border-gray-800 rounded-xl p-6 sm:p-8']) }}>
    @if(isset($title))
        <h3 class="text-xl font-semibold text-white text-center mb-6">{{ $title }}</h3>
    @endif
    {{ $slot }}
</div>