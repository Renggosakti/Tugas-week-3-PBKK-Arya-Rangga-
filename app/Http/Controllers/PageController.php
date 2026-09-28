<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function beranda(Request $request)
    {
        return view('beranda', ['user' => $request->query('user')]);
    }

    public function profil()
    {
        return view('profil');
    }

    public function ide()
    {
        return view('ide', ['ideas' => array_reverse(session('ideas', []))]);
    }

    public function kirimIde(Request $request)
    {
        $data = $request->validate([
            'nama'      => 'required|string|max:60',
            'judul'     => 'required|string|max:100',
            'kategori'  => 'required|in:Perencanaan,Tools,Memori,Evaluasi,Lainnya',
            'deskripsi' => 'required|string|max:500',
        ]);

        session()->push('ideas', $data + ['waktu' => now()->format('H:i')]);
        $query = $request->query('mode') === 'dark' ? ['mode' => 'dark'] : [];

        return redirect()->route('ide', $query)
            ->with('status', "Ide \"{$data['judul']}\" dari {$data['nama']} berhasil dikirim.");
    }
}
