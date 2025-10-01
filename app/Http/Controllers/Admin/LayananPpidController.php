<?php
// app/Http\Controllers/Admin/LayananPpidController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PpidRequest;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PpidRequestsExport;

class LayananPpidController extends Controller
{
    // HAPUS constructor ini
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }

    public function index()
    {
        // Tambahkan manual check auth di setiap method
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $data = PpidRequest::latest()->get();
        $stats = [
            'total' => PpidRequest::count(),
            'pending' => PpidRequest::where('status', 'pending')->count(),
            'processed' => PpidRequest::where('status', 'processed')->count(),
            'completed' => PpidRequest::where('status', 'completed')->count(),
            'rejected' => PpidRequest::where('status', 'rejected')->count(),
        ];

        return view('admin.layanan.ppid.index', compact('data', 'stats'));
    }

    public function edit($id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = PpidRequest::findOrFail($id);
        return view('admin.layanan.ppid.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = PpidRequest::findOrFail($id);
        
        $validated = $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nomor_handphone' => 'required|string|max:15',
            'email' => 'required|email',
            'informasi_dibutuhkan' => 'required|string',
            'alasan_meminta' => 'required|string',
            'cara_memperoleh' => 'required|in:soft_copy,hard_copy,melihat',
            'cara_mengirim' => 'required|in:email,pos,ambil_langsung',
            'status' => 'required|in:pending,processed,completed,rejected',
        ]);

        $item->update($validated);

        return redirect()->route('admin.layanan.ppid.index')
            ->with('success', 'Data permohonan PPID berhasil diperbarui');
    }

    public function destroy($id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = PpidRequest::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.layanan.ppid.index')
            ->with('success', 'Data permohonan PPID berhasil dihapus');
    }

    public function exportExcel()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        return Excel::download(new PpidRequestsExport, 'permohonan-ppid-' . date('Y-m-d') . '.xlsx');
    }
}