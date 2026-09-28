@props(['type' => 'info'])

@php
    $styles = [
        'success' => 'from-emerald-500 to-teal-500',
        'info'    => 'from-its-600 to-its-300',
    ][$type] ?? 'from-its-600 to-its-300';
    $icon = $type === 'success' ? '✅' : '👋';
@endphp

<div role="status" {{ $attributes->merge(['class' => "reveal flex items-center gap-3 rounded-2xl bg-gradient-to-r $styles px-5 py-4 text-sm font-semibold text-white shadow-lg"]) }}>
    <span class="text-xl">{{ $icon }}</span>
    <div>{{ $slot }}</div>
</div>
