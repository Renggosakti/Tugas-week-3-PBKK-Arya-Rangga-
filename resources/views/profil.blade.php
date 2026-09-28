@extends('layouts.app')
@section('title', 'Profil Mahasiswa')

@section('content')
    @php
        $foto = file_exists(public_path('images/foto.jpg'));
        $bahasa = [['C', 70], ['Python', 75], ['SQL', 70], ['PHP', 55], ['JavaScript', 50]];
        $tools = [['📊','Microsoft Excel'],['📝','Microsoft Word'],['📽️','PowerPoint'],['🧩','VS Code'],['🌿','Git & GitHub'],['🅻','Laravel'],['📓','Jupyter Notebook'],['🎨','Tailwind CSS']];
        $exp = [
            ['2026', 'Riset Cakra AI', 'Merancang arsitektur platform Agentic AI bersama kelompok.'],
            ['2026', 'Proyek Akhir Machine Learning', 'Klasifikasi prediksi penyakit jantung, dikerjakan berkelompok.'],
            ['2026', 'Praktikum & tugas kuliah', 'Basis data, desain dan analisis algoritma, serta metode numerik.'],
        ];
    @endphp

    {{-- Kartu identitas + foto --}}
    <section class="glass reveal flex flex-col items-center gap-6 rounded-3xl p-6 sm:flex-row sm:p-8" style="--i:0">
        <div class="size-40 shrink-0 overflow-hidden rounded-3xl border-2 {{ $foto ? 'border-its-500' : 'border-dashed border-its-500/50' }} bg-its-500/10">
            @if ($foto)
                <img src="{{ asset('images/foto.jpg') }}" alt="Foto Arya Rangga" class="size-full object-cover">
            @else
                <div class="grid size-full place-items-center p-3 text-center text-xs opacity-70"><div><div class="text-4xl">📷</div>Taruh foto di<br><code class="font-bold">public/images/foto.jpg</code></div></div>
            @endif
        </div>
        <div class="text-center sm:text-left">
            <p class="text-xs font-semibold text-its-500">Profil mahasiswa</p>
            <h1 class="text-3xl font-extrabold">Arya Rangga Putra Pratama</h1>
            <p class="mt-1 opacity-75">Teknik Informatika · Institut Teknologi Sepuluh Nopember</p>
            <div class="mt-4 flex flex-wrap justify-center gap-2 text-xs font-semibold sm:justify-start">
                <span class="rounded-full bg-its-500/15 px-3 py-1">NRP 5025241072</span>
                <span class="rounded-full bg-its-500/15 px-3 py-1">S1 Teknik Informatika</span>
                <span class="rounded-full bg-its-500/15 px-3 py-1">Surabaya</span>
            </div>
        </div>
    </section>

    <div class="mt-5 grid gap-5 sm:grid-cols-3">
        <x-info-card title="Departemen" icon="🎓" style="--i:1">Teknik Informatika</x-info-card>
        <x-info-card title="Kampus" icon="🏛️" style="--i:2">ITS Surabaya</x-info-card>
        <x-info-card title="Fokus studi" icon="🧠" style="--i:3">ML, Algoritma, Basis Data, Metnum</x-info-card>
    </div>

    <div class="mt-5 grid gap-5 lg:grid-cols-2">
        {{-- Bahasa pemrograman --}}
        <section class="glass reveal rounded-3xl p-6" style="--i:4">
            <h2 class="text-xl font-bold">Bahasa pemrograman</h2>
            <div class="mt-4 grid gap-4">
                @foreach ($bahasa as $b)
                    <div><div class="flex justify-between text-sm font-semibold"><span>{{ $b[0] }}</span><span class="opacity-60">{{ $b[1] }}%</span></div>
                    <div class="bar mt-1.5"><i style="--w:{{ $b[1] }}%"></i></div></div>
                @endforeach
            </div>
        </section>

        {{-- Aplikasi & tools --}}
        <section class="glass reveal rounded-3xl p-6" style="--i:5">
            <h2 class="text-xl font-bold">Aplikasi & tools</h2>
            <div class="mt-4 grid grid-cols-2 gap-3">
                @foreach ($tools as $t)
                    <div class="lift flex items-center gap-3 rounded-2xl bg-its-500/10 px-4 py-3 text-sm font-semibold"><span class="text-xl">{{ $t[0] }}</span>{{ $t[1] }}</div>
                @endforeach
            </div>
        </section>
    </div>

    {{-- Pengalaman --}}
    <section class="glass reveal mt-5 rounded-3xl p-6 sm:p-8" style="--i:6">
        <h2 class="text-xl font-bold">Pengalaman</h2>
        <ol class="tl mt-6 grid gap-6">
            @foreach ($exp as $e)
                <li class="relative pl-8"><span class="absolute top-1.5 left-0 size-3.5 rounded-full bg-its-500 ring-4 ring-its-500/25"></span>
                    <span class="text-xs font-semibold text-its-500">{{ $e[0] }}</span>
                    <p class="font-bold">{{ $e[1] }}</p><p class="text-sm opacity-75">{{ $e[2] }}</p></li>
            @endforeach
        </ol>
    </section>
@endsection
