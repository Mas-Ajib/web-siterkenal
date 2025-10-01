<?php
// app/Http/Controllers/Admin/LayananRehabilitasiController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rehabilitasi;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RehabilitasiExport;

class LayananRehabilitasiController extends Controller
{
    public function index()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $data = Rehabilitasi::latest()->get();
        $stats = [
            'total' => Rehabilitasi::count(),
            'with_wali' => Rehabilitasi::whereNotNull('wali')->count(),
            'with_riwayat' => Rehabilitasi::whereNotNull('riwayat')->count(),
        ];

        return view('admin.layanan.rehabilitasi.index', compact('data', 'stats'));
    }

    public function edit($id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = Rehabilitasi::findOrFail($id);
        return view('admin.layanan.rehabilitasi.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = Rehabilitasi::findOrFail($id);
        
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'wali' => 'nullable|string|max:255',
            'riwayat' => 'nullable|string',
        ]);

        $item->update($validated);

        return redirect()->route('admin.layanan.rehabilitasi.index')
            ->with('success', 'Data rehabilitasi berhasil diperbarui');
    }

    public function destroy($id)
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $item = Rehabilitasi::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.layanan.rehabilitasi.index')
            ->with('success', 'Data rehabilitasi berhasil dihapus');
    }

    public function exportExcel()
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        return Excel::download(new RehabilitasiExport, 'data-rehabilitasi-' . date('Y-m-d') . '.xlsx');
    }
}