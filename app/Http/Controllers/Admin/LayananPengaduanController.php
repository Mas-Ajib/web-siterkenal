<?php
// app/Http\Controllers/Admin/LayananPengaduanController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GratifikasiReport;
use App\Models\WhistleBlowingReport;
use App\Models\NarkobaReport;
use App\Models\KritikSaranReport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GratifikasiExport;
use App\Exports\WhistleblowingExport;
use App\Exports\PelaporanNarkobaExport;
use App\Exports\KritikSaranExport;

class LayananPengaduanController extends Controller
{
    // Method untuk Pelaporan Gratifikasi
    public function gratifikasi()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $data = GratifikasiReport::latest()->get();

        $bulanIni = GratifikasiReport::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $tahunIni = GratifikasiReport::whereYear('created_at', now()->year)->count();

        $stats = [
            'total' => GratifikasiReport::count(),
            'bulan_ini' => $bulanIni,
            'tahun_ini' => $tahunIni,
            'total_nilai' => GratifikasiReport::sum('nilai_nominal'),
            'rata_nilai' => GratifikasiReport::avg('nilai_nominal'),
        ];

        return view('admin.layanan.pengaduan.gratifikasi', compact('data', 'stats'));
    }

    public function editGratifikasi($id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = GratifikasiReport::findOrFail($id);
        return view('admin.layanan.pengaduan.gratifikasi-edit', compact('item'));
    }

    public function updateGratifikasi(Request $request, $id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = GratifikasiReport::findOrFail($id);

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jabatan' => 'required|string|max:255',
            'nama_instansi' => 'required|string|max:255',
            'unit_kerja' => 'required|string|max:255',
            'email' => 'required|email',
            'no_seluler' => 'required|string|max:15',
            'no_rumah' => 'nullable|string|max:15',
            'no_kantor' => 'nullable|string|max:15',
            'alamat_kantor' => 'required|string',
            'alamat_pengiriman' => 'required|string',
            'jenis_penerimaan' => 'required|string',
            'nilai_nominal' => 'required|numeric|min:0',
            'peristiwa_penerimaan' => 'required|string',
            'tempat_penerimaan' => 'required|string|max:255',
            'tanggal_penerimaan' => 'required|date',
            'nama_pemberi' => 'required|string|max:255',
            'pekerjaan_jabatan_pemberi' => 'required|string|max:255',
            'hubungan_dengan_pemberi' => 'required|string|max:255',
            'alamat_pemberi' => 'required|string',
            'telepon_pemberi' => 'nullable|string|max:15',
            'fax_pemberi' => 'nullable|string|max:15',
            'email_pemberi' => 'nullable|email',
            'alasan_pemberian' => 'required|string',
            'kronologi_penerimaan' => 'required|string',
            'link_dokumen' => 'nullable|url',
            'catatan_tambahan' => 'nullable|string',
            'bersedia_kompensasi' => 'required|boolean',
        ]);

        $item->update($validated);

        return redirect('/admin/layanan/pengaduan/gratifikasi')
            ->with('success', 'Data pelaporan gratifikasi berhasil diperbarui');
    }

    public function destroyGratifikasi($id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = GratifikasiReport::findOrFail($id);
        $item->delete();

        return redirect('/admin/layanan/pengaduan/gratifikasi')
            ->with('success', 'Data pelaporan gratifikasi berhasil dihapus');
    }

    public function exportGratifikasi()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        return Excel::download(new GratifikasiExport, 'data-pelaporan-gratifikasi-' . date('Y-m-d') . '.xlsx');
    }

    // Method untuk Whistle Blowing System
    public function whistleblowing()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $data = WhistleBlowingReport::latest()->get();

        $bulanIni = WhistleBlowingReport::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $tahunIni = WhistleBlowingReport::whereYear('created_at', now()->year)->count();

        // HITUNG STATS YANG SESUAI DENGAN STRUKTUR DATABASE
        $stats = [
            'total' => WhistleBlowingReport::count(),
            'bulan_ini' => $bulanIni,
            'tahun_ini' => $tahunIni,
            'anonim' => WhistleBlowingReport::whereNull('nama_pelapor')->count(),
            'teridentifikasi' => WhistleBlowingReport::whereNotNull('nama_pelapor')->count(),
            'dengan_email' => WhistleBlowingReport::whereNotNull('email')->count(),
            'setuju_pernyataan' => WhistleBlowingReport::where('pernyataan', true)->count(),
        ];

        return view('admin.layanan.pengaduan.whistleblowing', compact('data', 'stats'));
    }

    public function editWhistleblowing($id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = WhistleBlowingReport::findOrFail($id);
        return view('admin.layanan.pengaduan.whistleblowing-edit', compact('item'));
    }

    public function updateWhistleblowing(Request $request, $id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = WhistleBlowingReport::findOrFail($id);

        $validated = $request->validate([
            'jenis_pelanggaran' => 'required|string|max:255',
            'jenis_pelanggaran_lainnya' => 'nullable|string|max:255',
            'nama_pelapor' => 'nullable|string|max:255',
            'lokasi_kejadian' => 'required|string|max:255',
            'kota_kabupaten' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'tanggal_kejadian' => 'required|date',
            'waktu_kejadian' => 'nullable',
            'uraian_pengaduan' => 'required|string',
            'email' => 'nullable|email',
            'pernyataan' => 'required|boolean',
        ]);

        $item->update($validated);

        return redirect('/admin/layanan/pengaduan/whistleblowing')
            ->with('success', 'Data whistle blowing berhasil diperbarui');
    }

    public function destroyWhistleblowing($id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = WhistleBlowingReport::findOrFail($id);
        $item->delete();

        return redirect('/admin/layanan/pengaduan/whistleblowing')
            ->with('success', 'Data whistle blowing berhasil dihapus');
    }

    public function exportWhistleblowing()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        return Excel::download(new WhistleblowingExport, 'data-whistle-blowing-' . date('Y-m-d') . '.xlsx');
    }

    // Method untuk Pelaporan Penyalahgunaan Narkoba
    public function narkoba()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $data = NarkobaReport::latest()->get();

        $bulanIni = NarkobaReport::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $tahunIni = NarkobaReport::whereYear('created_at', now()->year)->count();

        $stats = [
            'total' => NarkobaReport::count(),
            'bulan_ini' => $bulanIni,
            'tahun_ini' => $tahunIni,
            'anonim' => NarkobaReport::whereNull('nama')->count(),
            'teridentifikasi' => NarkobaReport::whereNotNull('nama')->count(),
            'dengan_telepon' => NarkobaReport::whereNotNull('telepon')->count(),
        ];

        return view('admin.layanan.pengaduan.narkoba', compact('data', 'stats'));
    }

    public function editNarkoba($id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = NarkobaReport::findOrFail($id);
        return view('admin.layanan.pengaduan.narkoba-edit', compact('item'));
    }

    public function updateNarkoba(Request $request, $id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = NarkobaReport::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:15',
            'tempat_kejadian' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        $item->update($validated);

        return redirect('/admin/layanan/pengaduan/narkoba')
            ->with('success', 'Data pelaporan narkoba berhasil diperbarui');
    }

    public function destroyNarkoba($id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = NarkobaReport::findOrFail($id);
        $item->delete();

        return redirect('/admin/layanan/pengaduan/narkoba')
            ->with('success', 'Data pelaporan narkoba berhasil dihapus');
    }

    public function exportNarkoba()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        return Excel::download(new PelaporanNarkobaExport, 'data-pelaporan-narkoba-' . date('Y-m-d') . '.xlsx');
    }

    // Method untuk Kritik, Saran dan Pengaduan Layanan
    // Di file LayananPengaduanController.php - method kritiksaran()

    public function kritiksaran()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $data = KritikSaranReport::latest()->get();

        $bulanIni = KritikSaranReport::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $tahunIni = KritikSaranReport::whereYear('created_at', now()->year)->count();

        // HITUNG STATS YANG SESUAI DENGAN STRUKTUR DATABASE KRITIK SARAN
        $stats = [
            'total' => KritikSaranReport::count(),
            'bulan_ini' => $bulanIni,
            'tahun_ini' => $tahunIni,
            'anonim' => KritikSaranReport::whereNull('nama')->count(),
            'teridentifikasi' => KritikSaranReport::whereNotNull('nama')->count(),
            'dengan_kritik' => KritikSaranReport::memilikiKritik()->count(),
            'dengan_saran' => KritikSaranReport::memilikiSaran()->count(),
            'dengan_pengaduan' => KritikSaranReport::memilikiPengaduan()->count(),
            // HILANGKAN STATS YANG MENGGUNAKAN KOLOM JENIS
        ];

        return view('admin.layanan.pengaduan.kritiksaran', compact('data', 'stats'));
    }

    public function editKritiksaran($id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = KritikSaranReport::findOrFail($id);
        return view('admin.layanan.pengaduan.kritiksaran-edit', compact('item'));
    }

    public function updateKritiksaran(Request $request, $id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = KritikSaranReport::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:15',
            'kritik' => 'nullable|string',
            'saran' => 'nullable|string',
            'pengaduan_layanan' => 'nullable|string',
        ]);

        $item->update($validated);

        return redirect('/admin/layanan/pengaduan/kritiksaran')
            ->with('success', 'Data kritik dan saran berhasil diperbarui');
    }

    public function destroyKritiksaran($id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = KritikSaranReport::findOrFail($id);
        $item->delete();

        return redirect('/admin/layanan/pengaduan/kritiksaran')
            ->with('success', 'Data kritik saran berhasil dihapus');
    }

    public function exportKritiksaran()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        return Excel::download(new KritikSaranExport, 'data-kritik-saran-' . date('Y-m-d') . '.xlsx');
    }
}
