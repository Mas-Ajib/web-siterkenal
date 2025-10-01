<?php
// app/Http\Controllers/Admin/LayananKegiatanController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sosialisasi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SosialisasiExport;

class LayananKegiatanController extends Controller
{
    // Method untuk Sosialisasi
    public function sosialisasi()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $data = Sosialisasi::latest()->get();
        $stats = [
            'total' => Sosialisasi::count(),
            'bulan_ini' => Sosialisasi::bulanIni()->count(),
            'tahun_ini' => Sosialisasi::tahunIni()->count(),
            'total_peserta' => Sosialisasi::sum('jumlah_peserta'),
        ];

        return view('admin.layanan.kegiatan.sosialisasi', compact('data', 'stats'));
    }

    public function editSosialisasi($id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = Sosialisasi::findOrFail($id);
        return view('admin.layanan.kegiatan.sosialisasi-edit', compact('item'));
    }

    public function updateSosialisasi(Request $request, $id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = Sosialisasi::findOrFail($id);
        
        $validated = $request->validate([
            'jenis_sosialisasi' => 'required|string|max:255',
            'nama_penyelenggara' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'tempat' => 'required|string|max:255',
            'nama_penanggung_jawab' => 'required|string|max:255',
            'no_hp_penanggung_jawab' => 'required|string|max:15',
            'jumlah_peserta' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        $item->update($validated);

        return redirect()->route('admin.layanan.kegiatan.sosialisasi')
            ->with('success', 'Data sosialisasi berhasil diperbarui');
    }

    public function destroySosialisasi($id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = Sosialisasi::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.layanan.kegiatan.sosialisasi')
            ->with('success', 'Data sosialisasi berhasil dihapus');
    }

    public function exportSosialisasi()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        return Excel::download(new SosialisasiExport, 'data-sosialisasi-' . date('Y-m-d') . '.xlsx');
    }

    // Method untuk sub-layanan lainnya akan ditambahkan nanti
    public function magang()
    {
        return view('admin.layanan.kegiatan.magang');
    }

    public function tesUrine()
    {
        return view('admin.layanan.kegiatan.tes-urine');
    }

    public function tat()
    {
        return view('admin.layanan.kegiatan.tat');
    }
}