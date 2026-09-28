@extends('layouts.app')
@section('title', 'Beranda')

@section('content')
    @php
        $keep = request('mode') === 'dark' ? ['mode' => 'dark'] : [];
        $stack = ['Laravel 12', 'Blade Components', 'Vite', 'Tailwind CSS', 'Machine Learning', 'Basis Data', 'Algoritma', 'Metode Numerik'];
    @endphp

    @if ($user)
        <x-status-banner type="info" style="--i:0">Selamat datang, {{ $user }}! Silakan jelajahi dashboard ini.</x-status-banner>
    @endif

    <section class="glass reveal relative mt-5 overflow-hidden rounded-3xl p-8 sm:p-12" style="--i:1">
        <div class="pointer-events-none absolute -top-16 -right-16 size-64 rounded-full bg-its-500/30 blur-3xl"></div>
        <span class="inline-flex items-center gap-2 rounded-full bg-its-500/15 px-3 py-1 text-xs font-semibold"><span class="size-2 animate-pulse rounded-full bg-emerald-500"></span>Mahasiswa Teknik Informatika · ITS</span>
        <h1 class="mt-5 text-4xl font-extrabold leading-tight sm:text-6xl">Halo, saya<br><span class="text-shine">Arya Rangga</span></h1>
        <p class="mt-5 max-w-xl opacity-75">Saya mengerjakan proyek machine learning dan basis data, dan saat ini merancang Cakra AI, platform Agentic AI, bersama kelompok.</p>
        <div class="mt-7 flex flex-wrap gap-3">
            <a href="{{ route('ide', $keep) }}" class="rounded-xl bg-gradient-to-r from-its-600 to-its-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-its-500/30 transition hover:brightness-110">Kenalan dengan Cakra AI</a>
            <a href="{{ route('profil', $keep) }}" class="rounded-xl bg-its-500/10 px-6 py-3 text-sm font-semibold transition hover:bg-its-500/20">Profil lengkap</a>
        </div>
    </section>

    {{-- Departemen --}}
    <section class="glass reveal mt-5 rounded-3xl p-6 sm:p-8" style="--i:2">
        <div class="flex flex-wrap items-center gap-3">
            <span class="grid size-12 place-items-center rounded-2xl bg-gradient-to-br from-its-500 to-its-800 text-2xl">🏛️</span>
            <div><p class="text-xs font-semibold text-its-500">Tentang kampus</p><h2 class="text-2xl font-extrabold leading-tight">Departemen Teknik Informatika ITS</h2></div>
        </div>
        <p class="mt-4 max-w-3xl opacity-80">Departemen Teknik Informatika berada di Institut Teknologi Sepuluh Nopember, Surabaya, di bawah Fakultas Teknologi Elektro dan Informatika Cerdas. Mahasiswanya dibekali dasar komputasi yang kuat lalu memilih fokus sesuai minat, dari perangkat lunak sampai kecerdasan buatan.</p>
        <div class="mt-5 grid gap-3 sm:grid-cols-4">
            @foreach ([['💻','Rekayasa Perangkat Lunak'],['🧠','Kecerdasan Buatan'],['🌐','Jaringan & Keamanan'],['📊','Data & Komputasi']] as $b)
                <div class="lift rounded-2xl bg-its-500/10 p-4 text-center"><div class="text-2xl">{{ $b[0] }}</div><p class="mt-1 text-sm font-bold">{{ $b[1] }}</p></div>
            @endforeach
        </div>
        <div class="mt-4 flex flex-wrap gap-2 text-xs font-semibold"><span class="rounded-full bg-its-500/15 px-3 py-1">📍 Kampus ITS Sukolilo, Surabaya</span><span class="rounded-full bg-its-500/15 px-3 py-1">🎓 Program S1 Teknik Informatika</span></div>
    </section>

    {{-- Angka --}}
    <div class="mt-5 grid grid-cols-2 gap-5 sm:grid-cols-4">
        @foreach ([[4, 'Bidang studi'], [3, 'Halaman dashboard'], [1, 'Proyek ML selesai'], [1, 'Riset Cakra AI']] as $i => $s)
            <div class="glass lift reveal rounded-3xl p-5 text-center" style="--i:{{ $i + 2 }}">
                <p class="text-4xl font-extrabold text-its-600" data-count="{{ $s[0] }}">0</p>
                <p class="mt-1 text-xs font-semibold opacity-70">{{ $s[1] }}</p>
            </div>
        @endforeach
    </div>

    {{-- Fokus --}}
    <div class="mt-5 grid gap-5 sm:grid-cols-3">
        <x-info-card title="Machine Learning" icon="🫀" style="--i:6">Prediksi penyakit jantung</x-info-card>
        <x-info-card title="Basis Data" icon="🗄️" style="--i:7">Perancangan dan pengelolaan data</x-info-card>
        <x-info-card title="Riset kelompok" icon="🤖" style="--i:8">Cakra AI</x-info-card>
    </div>

    {{-- Tech stack berjalan --}}
    <div class="glass reveal mt-5 overflow-hidden rounded-3xl py-4" style="--i:9">
        <div class="marquee">
            @foreach (array_merge($stack, $stack) as $t)
                <span class="mx-2 shrink-0 rounded-full bg-its-500/15 px-5 py-2 text-sm font-semibold">{{ $t }}</span>
            @endforeach
        </div>
    </div>

    <script>
        document.querySelectorAll('[data-count]').forEach(el => {
            const to = +el.dataset.count; let n = 0;
            const t = setInterval(() => { el.textContent = ++n; if (n >= to) clearInterval(t); }, 260);
        });
    </script>
@endsection
