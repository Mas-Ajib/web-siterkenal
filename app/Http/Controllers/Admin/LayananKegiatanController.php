<?php
// app/Http\Controllers/Admin/LayananKegiatanController.php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Sosialisasi;
use App\Models\TesUrineMandiri;
use App\Models\Tat;
use App\Models\Magang;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SosialisasiExport;
use App\Exports\TesUrineMandiriExport;
use App\Exports\TatExport;
use App\Exports\MagangExport;

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


    // Method untuk Tes Urine Mandiri
    public function tesUrine()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $data = TesUrineMandiri::latest()->get();
        
        // Query manual untuk stats
        $bulanIni = TesUrineMandiri::whereMonth('tanggal', now()->month)
                    ->whereYear('tanggal', now()->year)
                    ->count();
                    
        $tahunIni = TesUrineMandiri::whereYear('tanggal', now()->year)->count();
        
        $stats = [
            'total' => TesUrineMandiri::count(),
            'bulan_ini' => $bulanIni,
            'tahun_ini' => $tahunIni,
            'total_peserta' => TesUrineMandiri::sum('jumlah_peserta'),
            'masyarakat' => TesUrineMandiri::where('jenis_tes', 'Masyarakat')->count(),
            'pemerintah' => TesUrineMandiri::where('jenis_tes', 'Pemerintah')->count(),
            'swasta' => TesUrineMandiri::where('jenis_tes', 'Swasta')->count(),
            'pendidikan' => TesUrineMandiri::where('jenis_tes', 'Pendidikan')->count(),
        ];

        return view('admin.layanan.kegiatan.tes-urine', compact('data', 'stats'));
    }

    // TAMBAHKAN METHOD INI
    public function editTesUrine($id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = TesUrineMandiri::findOrFail($id);
        return view('admin.layanan.kegiatan.tes-urine-edit', compact('item'));
    }

    public function updateTesUrine(Request $request, $id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = TesUrineMandiri::findOrFail($id);
        
        $validated = $request->validate([
            'jenis_tes' => 'required|in:Masyarakat,Pemerintah,Swasta,Pendidikan',
            'nama_penyelenggara' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'tempat' => 'required|string|max:255',
            'nama_penanggung_jawab' => 'required|string|max:255',
            'nohp_penanggung_jawab' => 'required|string|max:15',
            'jumlah_peserta' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        $item->update($validated);

        // Redirect ke halaman tes urine
        return redirect('/admin/layanan/kegiatan/tes-urine')
            ->with('success', 'Data tes urine mandiri berhasil diperbarui');
    }

    public function destroyTesUrine($id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = TesUrineMandiri::findOrFail($id);
        $item->delete();

        return redirect('/admin/layanan/kegiatan/tes-urine')
            ->with('success', 'Data tes urine mandiri berhasil dihapus');
    }

    public function exportTesUrine()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        return Excel::download(new TesUrineMandiriExport, 'data-tes-urine-mandiri-' . date('Y-m-d') . '.xlsx');
    }


    // Method untuk TAT
    public function tat()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $data = Tat::latest()->get();
        
        // Stats
        $bulanIni = Tat::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count();
                    
        $stats = [
            'total' => Tat::count(),
            'bulan_ini' => $bulanIni,
            'positif' => Tat::positif()->count(),
            'negatif' => Tat::negatif()->count(),
            'total_berat' => Tat::sum('berat_barang_bukti'),
        ];

        return view('admin.layanan.kegiatan.tat', compact('data', 'stats'));
    }

    public function editTat($id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = Tat::findOrFail($id);
        return view('admin.layanan.kegiatan.tat-edit', compact('item'));
    }

    public function updateTat(Request $request, $id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = Tat::findOrFail($id);
        
        $validated = $request->validate([
            'instansi_pemohon' => 'required|string|max:255',
            'nama_tersangka' => 'required|string|max:255',
            'tanggal_penangkapan' => 'required|date',
            'jenis_barang_bukti' => 'required|string|max:255',
            'berat_barang_bukti' => 'required|string|max:50',
            'hasil_urine' => 'required|in:Positif,Negatif',
        ]);

        $item->update($validated);

        return redirect('/admin/layanan/kegiatan/tat')
            ->with('success', 'Data TAT berhasil diperbarui');
    }

    public function destroyTat($id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = Tat::findOrFail($id);
        $item->delete();

        return redirect('/admin/layanan/kegiatan/tat')
            ->with('success', 'Data TAT berhasil dihapus');
    }

    public function exportTat()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        return Excel::download(new TatExport, 'data-tat-' . date('Y-m-d') . '.xlsx');
    }

    // Method untuk Magang 
    public function magang()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $data = Magang::latest()->get();
        
        $bulanIni = Magang::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count();
                    
        $tahunIni = Magang::whereYear('created_at', now()->year)->count();
        
        $stats = [
            'total' => Magang::count(),
            'bulan_ini' => $bulanIni,
            'tahun_ini' => $tahunIni,
            'total_peserta' => Magang::sum('jumlah_peserta'),
            'rata_rata_waktu' => round(Magang::avg('jangka_waktu'), 1),
        ];

        return view('admin.layanan.kegiatan.magang', compact('data', 'stats'));
    }


    public function editMagang($id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = Magang::findOrFail($id);
        return view('admin.layanan.kegiatan.magang-edit', compact('item'));
    }

    public function updateMagang(Request $request, $id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = Magang::findOrFail($id);
        
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email',
            'instansi' => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'kontak' => 'required|string|max:15',
            'jangka_waktu' => 'required|integer|min:1',
            'jumlah_peserta' => 'required|integer|min:1',
        ]);

        $item->update($validated);

        return redirect('/admin/layanan/kegiatan/magang')
            ->with('success', 'Data magang berhasil diperbarui');
    }

    public function destroyMagang($id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = Magang::findOrFail($id);
        $item->delete();

        return redirect('/admin/layanan/kegiatan/magang')
            ->with('success', 'Data magang berhasil dihapus');
    }

    public function exportMagang()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        return Excel::download(new MagangExport, 'data-magang-' . date('Y-m-d') . '.xlsx');
    }
}
