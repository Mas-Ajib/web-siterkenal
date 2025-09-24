<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicFormController extends Controller
{
    public function skhpn()
    {
        return view('forms.skhpn');
    }

    public function submitSkhpn(Request $request)
    {
        // validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
        ]);

        // simpan ke database (sementara dump dulu)
        return back()->with('success', 'Form SKHPN berhasil dikirim!');
    }

    public function rehabilitasi()
    {
        return view('forms.rehabilitasi');
    }

    public function submitRehabilitasi(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        return back()->with('success', 'Form Rehabilitasi berhasil dikirim!');
    }

    public function kegiatan()
    {
        return view('forms.kegiatan');
    }

    public function submitKegiatan(Request $request)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
        ]);

        return back()->with('success', 'Form Kegiatan berhasil dikirim!');
    }

    public function informasi()
    {
        return view('forms.informasi');
    }

    public function submitInformasi(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'pesan' => 'required|string',
        ]);

        return back()->with('success', 'Form Informasi berhasil dikirim!');
    }

    public function pengaduan()
    {
        return view('forms.pengaduan');
    }

    public function submitPengaduan(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        return back()->with('success', 'Form Pengaduan berhasil dikirim!');
    }
}

