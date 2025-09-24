<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PpidRequest;

class PpidController extends Controller
{
    public function create()
    {
        return view('forms.ppid');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:20',
            'email' => 'required|email',
            'informasi_dibutuhkan' => 'required|string',
            'alasan_permintaan' => 'required|string',
            'cara_memperoleh' => 'required|string',
            'cara_mengirim' => 'required|string',
        ]);

        PpidRequest::create($request->all());

        return redirect()->back()->with('success', 'Permohonan informasi berhasil dikirim.');
    }
}
