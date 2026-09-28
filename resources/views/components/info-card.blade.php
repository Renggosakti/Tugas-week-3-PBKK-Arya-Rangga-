@props(['title', 'icon' => '✨'])

<div {{ $attributes->merge(['class' => 'glass lift reveal rounded-3xl p-6']) }}>
    <div class="flex items-center gap-3">
        <span class="grid size-10 place-items-center rounded-xl bg-its-500/15 text-xl">{{ $icon }}</span>
        <h3 class="text-sm font-semibold opacity-70">{{ $title }}</h3>
    </div>
    <div class="mt-4 text-lg font-bold leading-snug">{{ $slot }}</div>
</div>
