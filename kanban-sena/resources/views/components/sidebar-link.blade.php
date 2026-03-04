@props(['active', 'icon'])

@php
$classes = ($active ?? false)
            ? 'flex items-center space-x-3 px-4 py-3 bg-white/10 text-white border-l-4 border-sena-green rounded-r-md transition-all'
            : 'flex items-center space-x-3 px-4 py-3 text-white/70 hover:text-white hover:bg-white/5 border-l-4 border-transparent rounded-r-md transition-all group';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <i class="bi bi-{{ $icon }} text-lg {{ ($active ?? false) ? 'text-sena-green' : 'text-white/40 group-hover:text-sena-green' }}"></i>
    <span class="text-sm font-medium">{{ $slot }}</span>
</a>
