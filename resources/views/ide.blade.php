@extends('layouts.app')
@section('title', 'Ide-Riset')

@section('content')
    @php
        $keep = request('mode') === 'dark' ? ['mode' => 'dark'] : [];
        $nodes = [
            ['🙋', 'Pengguna', 'Menyampaikan tujuan dalam bahasa alami, misalnya "rangkum jurnal ini dan buat rencana belajar".'],
            ['🧭', 'Orchestrator', 'Otak platform. Menerima tujuan, memecahnya jadi langkah, lalu membagi tugas ke modul yang tepat.'],
            ['🗺️', 'Planner', 'Menyusun urutan langkah dan memperbaiki rencana kalau ada langkah yang gagal.'],
            ['🛠️', 'Tools & API', 'Menjalankan aksi nyata: pencarian, baca dokumen, kueri database, eksekusi kode.'],
            ['🧠', 'Memori', 'Menyimpan konteks percakapan dan hasil sebelumnya supaya agent tidak mulai dari nol.'],
            ['📄', 'Output', 'Hasil akhir yang sudah diverifikasi: ringkasan, laporan, atau tindakan yang selesai.'],
        ];
        $caps = [
            ['🎯', 'Perencanaan tugas', 'Memecah tujuan besar menjadi langkah kecil yang bisa dikerjakan berurutan.'],
            ['🔌', 'Pemanggilan tools', 'Agent memilih dan memakai alat yang sesuai, bukan sekadar menjawab teks.'],
            ['💾', 'Memori jangka panjang', 'Konteks tersimpan di database sehingga percakapan berikutnya nyambung.'],
            ['🛡️', 'Evaluasi & guardrail', 'Setiap hasil dicek sebelum sampai ke pengguna untuk menekan kesalahan.'],
        ];
        $road = [['Tahap 1', 'Riset & kebutuhan', 'Menentukan masalah dan pengguna sasaran.'], ['Tahap 2', 'Desain arsitektur', 'Menetapkan alur agent dan pilihan tools.'], ['Tahap 3', 'Prototipe', 'Membangun agent inti dengan satu skenario.'], ['Tahap 4', 'Evaluasi', 'Mengukur akurasi dan memperbaiki.']];
        $inp = 'w-full rounded-xl border border-its-500/30 bg-white/80 px-4 py-3 text-sm text-its-950 outline-none transition focus:border-its-500 focus:ring-4 focus:ring-its-500/20';
    @endphp

    {{-- Hero --}}
    <section class="reveal" style="--i:0">
        <span class="inline-flex items-center gap-2 rounded-full bg-its-500/15 px-3 py-1 text-xs font-semibold"><span class="size-2 animate-pulse rounded-full bg-emerald-500"></span>Riset kelompok · Agentic AI</span>
        <h1 class="mt-4 text-5xl font-extrabold leading-tight sm:text-6xl"><span class="text-shine">Cakra AI</span></h1>
        <p class="mt-2 text-xl font-semibold">Asisten riset akademik yang merencanakan, bertindak, dan memverifikasi sendiri.</p>
        <p class="mt-3 max-w-2xl opacity-75">Cakra berarti roda atau lingkaran: AI ini bekerja dalam siklus tanpa putus, dari menerima tujuan sampai hasilnya terbukti benar.</p>
    </section>

    @if (session('status'))
        <x-status-banner type="success" class="mt-6" style="--i:1">{{ session('status') }}</x-status-banner>
    @endif

    {{-- Ilustrasi orbit --}}
    <section class="glass reveal mt-6 overflow-hidden rounded-3xl p-4 sm:p-8" style="--i:2">
        <h2 class="text-xl font-bold">Cara kerja Cakra AI</h2>
        <p class="text-sm opacity-70">Semua komponen mengorbit satu inti dan saling bertukar data.</p>
        <svg viewBox="0 0 600 360" class="mx-auto mt-2 w-full max-w-2xl" role="img" aria-label="Ilustrasi orbit komponen Cakra AI">
            <defs>
                <radialGradient id="core"><stop offset="0" stop-color="#d3e8ff"/><stop offset=".45" stop-color="#1c7fd6"/><stop offset="1" stop-color="#08346b"/></radialGradient>
                <linearGradient id="sat" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#6fb4f5"/><stop offset="1" stop-color="#0b5cad"/></linearGradient>
                <filter id="glow" x="-50%" y="-50%" width="200%" height="200%"><feGaussianBlur stdDeviation="9"/></filter>
            </defs>
            <g transform="translate(300 180)">
                <circle r="70" fill="#1c7fd6" opacity=".35" filter="url(#glow)"><animate attributeName="r" values="62;82;62" dur="4s" repeatCount="indefinite"/></circle>
                <circle r="72" fill="none" stroke="#1c7fd6" stroke-opacity=".35" stroke-dasharray="3 7"/>
                <circle r="120" fill="none" stroke="#1c7fd6" stroke-opacity=".4"/>
                <circle r="165" fill="none" stroke="#1c7fd6" stroke-opacity=".3" stroke-dasharray="10 8"/>
                <g><animateTransform attributeName="transform" type="rotate" from="0" to="360" dur="36s" repeatCount="indefinite"/>
                    @foreach ([[0,'🗺️','Planner'],[120,'🛠️','Tools'],[240,'🧠','Memori']] as $s)
                        <g transform="rotate({{ $s[0] }}) translate(120 0)"><g transform="rotate(-{{ $s[0] }})"><g><animateTransform attributeName="transform" type="rotate" from="0" to="-360" dur="36s" repeatCount="indefinite"/>
                            <circle r="27" fill="url(#sat)" stroke="#fff" stroke-opacity=".6" stroke-width="2"/><text y="8" text-anchor="middle" font-size="24">{{ $s[1] }}</text><text y="46" text-anchor="middle" font-size="12" font-weight="700" fill="currentColor">{{ $s[2] }}</text>
                        </g></g></g>
                    @endforeach
                    <circle cx="72" r="4" fill="#fff"/>
                </g>
                <g><animateTransform attributeName="transform" type="rotate" from="360" to="0" dur="52s" repeatCount="indefinite"/>
                    @foreach ([[45,'🙋','Pengguna'],[225,'📄','Output']] as $s)
                        <g transform="rotate({{ $s[0] }}) translate(165 0)"><g transform="rotate(-{{ $s[0] }})"><g><animateTransform attributeName="transform" type="rotate" from="0" to="360" dur="52s" repeatCount="indefinite"/>
                            <circle r="27" fill="#fff" stroke="#1c7fd6" stroke-width="3"/><text y="8" text-anchor="middle" font-size="24">{{ $s[1] }}</text><text y="46" text-anchor="middle" font-size="12" font-weight="700" fill="currentColor">{{ $s[2] }}</text>
                        </g></g></g>
                    @endforeach
                    <circle cx="165" r="4" fill="#6fb4f5"/><circle cx="-165" r="4" fill="#6fb4f5"/>
                </g>
                <circle r="48" fill="url(#core)" stroke="#fff" stroke-opacity=".7" stroke-width="2"/>
                <text y="-2" text-anchor="middle" font-size="18" font-weight="800" fill="#fff">Cakra</text>
                <text y="16" text-anchor="middle" font-size="11" font-weight="700" fill="#d3e8ff">AI CORE</text>
            </g>
        </svg>
        <div class="mt-4 grid gap-3 sm:grid-cols-4">
            @foreach ([['1','Terima','Pengguna menyampaikan tujuan.'],['2','Rencanakan','Planner memecah jadi langkah.'],['3','Eksekusi','Tools dan memori dipakai.'],['4','Verifikasi','Hasil dicek sebelum dikirim.']] as $st)
                <div class="rounded-2xl bg-its-500/10 p-4"><span class="grid size-7 place-items-center rounded-full bg-its-600 text-xs font-bold text-white">{{ $st[0] }}</span><p class="mt-2 font-bold">{{ $st[1] }}</p><p class="text-xs opacity-70">{{ $st[2] }}</p></div>
            @endforeach
        </div>
    </section>

    {{-- Kemampuan --}}
    <div class="mt-6 grid gap-5 sm:grid-cols-2">
        @foreach ($caps as $i => $c)
            <x-info-card :title="$c[1]" :icon="$c[0]" style="--i:{{ $i + 3 }}">
                <span class="text-sm font-medium opacity-80">{{ $c[2] }}</span>
            </x-info-card>
        @endforeach
    </div>

    {{-- Roadmap --}}
    <section class="glass reveal mt-6 rounded-3xl p-6 sm:p-8" style="--i:7">
        <h2 class="text-xl font-bold">Rencana pengerjaan</h2>
        <ol class="mt-6 grid gap-4 sm:grid-cols-4">
            @foreach ($road as $i => $r)
                <li class="relative rounded-2xl border border-its-500/25 p-4 {{ $i === 0 ? 'bg-its-500/10' : '' }}">
                    <span class="text-xs font-semibold text-its-500">{{ $r[0] }}{{ $i === 0 ? ' · sedang berjalan' : '' }}</span>
                    <p class="mt-1 font-bold">{{ $r[1] }}</p>
                    <p class="mt-1 text-xs opacity-70">{{ $r[2] }}</p>
                </li>
            @endforeach
        </ol>
    </section>

    {{-- Papan ide --}}
    <div class="mt-6 grid gap-5 lg:grid-cols-5">
        <section class="glass reveal rounded-3xl p-6 lg:col-span-3" style="--i:8">
            <h2 class="text-xl font-bold">Kirim ide baru</h2>
            <p class="text-sm opacity-70">Ide akan muncul di papan sebelah dan tersimpan selama sesi.</p>
            <form method="POST" action="{{ route('ide.kirim', $keep) }}" class="mt-5 grid gap-4">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2">
                    <input name="nama" value="{{ old('nama') }}" placeholder="Nama kamu" class="{{ $inp }}" required>
                    <select name="kategori" class="{{ $inp }}" required>
                        @foreach (['Perencanaan', 'Tools', 'Memori', 'Evaluasi', 'Lainnya'] as $k)
                            <option {{ old('kategori') === $k ? 'selected' : '' }}>{{ $k }}</option>
                        @endforeach
                    </select>
                </div>
                <input name="judul" value="{{ old('judul') }}" placeholder="Judul ide" class="{{ $inp }}" required>
                <textarea name="deskripsi" rows="4" placeholder="Jelaskan idenya: masalah apa yang diselesaikan?" class="{{ $inp }}" required>{{ old('deskripsi') }}</textarea>
                @if ($errors->any())<p class="text-sm font-semibold text-red-500">{{ $errors->first() }}</p>@endif
                <button class="justify-self-start rounded-xl bg-gradient-to-r from-its-600 to-its-500 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-its-500/30 transition hover:brightness-110 active:scale-95">Kirim ide</button>
            </form>
        </section>

        <section class="glass reveal rounded-3xl p-6 lg:col-span-2" style="--i:9">
            <h2 class="text-xl font-bold">Papan ide <span class="ml-1 rounded-full bg-its-500/15 px-2 py-0.5 text-xs">{{ count($ideas) }}</span></h2>
            <div class="mt-4 grid max-h-96 gap-3 overflow-y-auto pr-1">
                @forelse ($ideas as $d)
                    <article class="rounded-2xl border border-its-500/25 p-4">
                        <div class="flex items-center gap-3">
                            <span class="grid size-9 place-items-center rounded-full bg-its-600 text-sm font-bold text-white">{{ strtoupper(mb_substr($d['nama'], 0, 1)) }}</span>
                            <div class="min-w-0 leading-tight"><p class="truncate text-sm font-bold">{{ $d['judul'] }}</p><p class="text-xs opacity-60">{{ $d['nama'] }} · {{ $d['waktu'] }}</p></div>
                            <span class="ml-auto rounded-full bg-its-500/15 px-2 py-0.5 text-xs font-semibold">{{ $d['kategori'] }}</span>
                        </div>
                        <p class="mt-2 text-sm opacity-75">{{ $d['deskripsi'] }}</p>
                    </article>
                @empty
                    <p class="rounded-2xl border border-dashed border-its-500/40 p-6 text-center text-sm opacity-70">Belum ada ide. Kirim yang pertama lewat formulir.</p>
                @endforelse
            </div>
        </section>
    </div>

@endsection
