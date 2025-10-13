<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminManagementController extends Controller
{
    public function index()
    {
        $admins = Admin::orderBy('created_at', 'desc')->get();
        
        // Inisialisasi stats dengan nilai default untuk menghindari error
        $stats = [
            'total' => $admins->count(),
            'active_today' => 0, // Default value
            'super_admins' => $admins->where('is_superadmin', true)->count(),
            'regular_admins' => $admins->where('is_superadmin', false)->count(),
        ];

        return view('admin.management.index', compact('admins', 'stats'));
    }

    public function create()
    {
        return view('admin.management.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:8|confirmed',
            'is_superadmin' => 'boolean',
        ]);

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_superadmin' => $request->is_superadmin ?? false,
        ]);

        return redirect()->route('admin.management.index')
            ->with('success', 'Admin berhasil ditambahkan.');
    }

    public function edit(Admin $admin)
    {
        return view('admin.management.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'password' => 'nullable|min:8|confirmed',
            'is_superadmin' => 'boolean',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'is_superadmin' => $request->is_superadmin ?? false,
        ];

        if ($request->password) {
            $updateData['password'] = Hash::make($request->password);
        }

        $admin->update($updateData);

        return redirect()->route('admin.management.index')
            ->with('success', 'Admin berhasil diperbarui.');
    }

    public function destroy(Admin $admin)
    {
        // Prevent deleting yourself
        if ($admin->id === auth()->guard('admin')->id()) {
            return redirect()->route('admin.management.index')
                ->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        $admin->delete();

        return redirect()->route('admin.management.index')
            ->with('success', 'Admin berhasil dihapus.');
    }
}