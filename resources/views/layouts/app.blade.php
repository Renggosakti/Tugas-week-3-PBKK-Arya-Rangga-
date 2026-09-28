@php
    $dark  = request()->query('mode') === 'dark';
    $mode  = $dark ? 'dark' : 'light';
    $keep  = $dark ? ['mode' => 'dark'] : [];
    $menu  = [
        ['route' => 'beranda', 'label' => 'Beranda',   'icon' => '🏠'],
        ['route' => 'profil',  'label' => 'Profil',    'icon' => '🎓'],
        ['route' => 'ide',     'label' => 'Ide-Riset', 'icon' => '🤖'],
    ];
    $bodyClass = $dark ? 'bg-its-950 text-its-100' : 'bg-its-50 text-its-950';
@endphp
<!DOCTYPE html>
<html lang="id" data-mode="{{ $mode }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') | Portofolio Akademik ITS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<script>if(localStorage.getItem('sb')==='1')document.documentElement.setAttribute('data-collapsed','')</script>
</head>
<body class="min-h-screen font-sans antialiased {{ $bodyClass }}">

    {{-- Latar animasi --}}
    <div class="bg-stage" aria-hidden="true">
        <div class="blob a"></div><div class="blob b"></div><div class="blob c"></div>
        <div class="grid-lines"></div><div class="spotlight"></div>
    </div>

    {{-- Tombol menu (mobile) --}}
    <button id="menu-btn" class="glass fixed top-4 left-4 z-50 rounded-xl px-3 py-2 lg:hidden" aria-label="Buka menu">☰</button>

    {{-- Sidebar kiri --}}
    <aside id="sidebar" class="glass fixed inset-y-3 left-3 z-40 flex w-64 -translate-x-[120%] flex-col rounded-3xl p-5 transition-transform duration-300 lg:translate-x-0">
        <div class="flex items-center gap-3">
            <div class="grid size-12 place-items-center rounded-2xl bg-gradient-to-br from-its-500 to-its-800 text-lg font-bold text-white">AR</div>
            <div class="leading-tight lbl">
                <p class="font-bold">Rangs</p>
                <p class="text-xs opacity-70">Informatika ITS</p>
            </div>
        </div>

        <button id="collapse-btn" class="glass absolute top-8 -right-3 hidden size-7 place-items-center rounded-full text-sm lg:grid" aria-label="Buka/tutup sidebar">‹</button>

        <nav class="mt-8 flex flex-col gap-1.5">
            @foreach ($menu as $item)
                @php $active = request()->routeIs($item['route']) || ($item['route'] === 'beranda' && request()->is('beranda')); @endphp
                <a href="{{ route($item['route'], $keep) }}"
                   class="flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold transition-all duration-300
                          {{ $active ? 'bg-gradient-to-r from-its-600 to-its-500 text-white shadow-lg shadow-its-500/30 translate-x-1'
                                     : 'hover:bg-its-500/10 hover:translate-x-1' }}">
                    <span class="text-lg">{{ $item['icon'] }}</span><span class="lbl">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>

        <a href="{{ url()->current() . ($dark ? '' : '?mode=dark') }}"
           class="mt-auto flex items-center justify-between rounded-2xl bg-its-500/10 px-4 py-3 text-sm font-semibold transition hover:bg-its-500/20">
            <span>{{ $dark ? '☀️' : '🌙' }}<span class="lbl"> {{ $dark ? 'Mode terang' : 'Mode gelap' }}</span></span>
        </a>
    </aside>

    {{-- Konten --}}
    <div class="content-wrap">
        <main class="page mx-auto max-w-5xl px-5 pt-20 pb-10 lg:pt-10">
            @yield('content')
        </main>

        <footer class="mx-auto max-w-5xl px-5 pb-8 text-center text-xs opacity-60">
            © 2026 Departemen Teknik Informatika, Institut Teknologi Sepuluh Nopember, Surabaya
        </footer>
    </div>
</body>
</html>
