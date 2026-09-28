# Tugas 4: Aplikasi Multi-View Profil Akademik

Mini-website akademik pribadi berbentuk dashboard, dibangun dengan **Laravel 12**, **Blade**, **Tailwind CSS**, dan **Vite**. Berisi profil diri, rancangan platform Agentic AI kelompok (**Cakra AI**), dan formulir pengumpulan ide.

## Identitas

| | |
|---|---|
| Nama | Arya Rangga Putra Pratama |
| NRP | 5025241072 |
| Program Studi | S1 Teknik Informatika |
| Kampus | Institut Teknologi Sepuluh Nopember (ITS) |
| Tugas | Pertemuan 4, Implementasi Layout & Komponen |

## Fitur

- **Dashboard dengan sidebar kiri** yang bisa dibuka-tutup (pilihan diingat di browser).
- **Beranda**: perkenalan diri, pengenalan Departemen Teknik Informatika ITS, statistik, dan tech stack.
- **Profil**: foto, identitas, bahasa pemrograman, aplikasi/tools, dan pengalaman.
- **Ide-Riset**: ilustrasi orbit arsitektur Cakra AI, kemampuan platform, roadmap, form ide, dan papan ide.
- **Efek visual**: latar gradient bergerak, cahaya mengikuti kursor, ripple saat klik, transisi antar halaman, dan animasi kartu.

## Pemenuhan Spesifikasi Tugas

| Ketentuan | Implementasi |
|---|---|
| Master layout terpusat | `resources/views/layouts/app.blade.php` (title dinamis, sidebar/navbar, container konten, footer ITS) |
| Tanpa duplikasi HTML | Semua halaman hanya memakai `@extends('layouts.app')` dan `@section` |
| 3 halaman anak | Beranda `/`, Profil `/profil-mahasiswa`, Ide-Riset `/ide-agent` |
| Satu controller | `app/Http/Controllers/PageController.php` |
| Komponen `<x-info-card>` | `resources/views/components/info-card.blade.php` (props `title`, `icon`, slot) |
| Komponen `<x-status-banner>` | `resources/views/components/status-banner.blade.php` (prop `type`, slot) |
| Vite + NPM, tanpa CDN | Tailwind CSS v4 dan font lewat NPM, dikompilasi lokal (`vite.config.js`) |

### Tantangan Ekstra

1. **Toggle tema dinamis**: `/ide-agent?mode=dark` mengubah tema lewat variabel Blade (`$dark`, `$bodyClass`) yang menghasilkan class Tailwind berbeda. Mode terbawa saat berpindah halaman.
2. **Alert status interaktif**: `/beranda?user=Andi` (atau `/?user=Andi`) menampilkan `<x-status-banner>` berisi pesan selamat datang sesuai nama di URL.

## Rute

| Method | URL | Keterangan |
|---|---|---|
| GET | `/` dan `/beranda` | Beranda (mendukung `?user=Nama`) |
| GET | `/profil-mahasiswa` | Profil mahasiswa |
| GET | `/ide-agent` | Ide-Riset (mendukung `?mode=dark`) |
| POST | `/ide-agent` | Kirim ide (disimpan di session) |

## Struktur File Utama

```
app/Http/Controllers/PageController.php
resources/
├── css/app.css
├── js/app.js
└── views/
    ├── layouts/app.blade.php
    ├── components/
    │   ├── info-card.blade.php
    │   └── status-banner.blade.php
    ├── beranda.blade.php
    ├── profil.blade.php
    └── ide.blade.php
routes/web.php
vite.config.js
```

## Cara Menjalankan

Prasyarat: PHP 8.2+, Composer, Node.js (LTS).

```bash
git clone <url-repository-ini>
cd <nama-folder>

composer install
cp .env.example .env
php artisan key:generate
php artisan migrate

npm install
```

Jalankan di dua terminal:

```bash
php artisan serve
```
```bash
npm run dev
```

Buka `http://127.0.0.1:8000`.

Contoh URL untuk mencoba tantangan:

- `http://127.0.0.1:8000/ide-agent?mode=dark`
- `http://127.0.0.1:8000/beranda?user=Andi`

> Untuk menampilkan foto di halaman Profil, simpan foto sebagai `public/images/foto.jpg`.

## Teknologi

Laravel 12, Blade Components, Tailwind CSS v4, Vite, `@fontsource-variable/plus-jakarta-sans`.

## Catatan

Foto, persentase skill, dan isi pengalaman pada halaman Profil serta roadmap Cakra AI bersifat contoh dan dapat disesuaikan.
