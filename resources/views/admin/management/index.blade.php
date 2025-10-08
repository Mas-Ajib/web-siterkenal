<!-- resources/views/admin/management/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Kelola Admin')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-900">Kelola Admin</h1>
    <div class="flex space-x-3">
        <a href="{{ route('admin.management.create') }}" 
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-150">
            <i class="fas fa-plus mr-2"></i>Tambah Admin
        </a>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-blue-100 rounded-lg">
                <i class="fas fa-users text-blue-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Total Admin</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total'] }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-purple-100 rounded-lg">
                <i class="fas fa-crown text-purple-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Super Admin</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['superadmin'] }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-green-100 rounded-lg">
                <i class="fas fa-user-shield text-green-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Admin Biasa</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['admin'] }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-orange-100 rounded-lg">
                <i class="fas fa-user-plus text-orange-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Hari Ini</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['active_today'] }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Daftar Admin</h3>
            <span class="text-sm text-gray-500">{{ $admins->count() }} admin ditemukan</span>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Admin</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Dibuat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($admins as $index => $admin)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <span class="text-blue-600 font-semibold text-sm">
                                        {{ strtoupper(substr($admin->name, 0, 2)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $admin->name }}
                                    @if($admin->id === auth()->guard('admin')->id())
                                        <span class="ml-2 px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">Anda</span>
                                    @endif
                                </div>
                                <div class="text-sm text-gray-500">
                                    ID: {{ $admin->id }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $admin->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        @if($admin->role == 'superadmin')
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                <i class="fas fa-crown mr-1"></i>Super Admin
                            </span>
                        @else
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                <i class="fas fa-user-shield mr-1"></i>Admin
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $admin->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $admin->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div>{{ $admin->created_at->format('d/m/Y') }}</div>
                        <div class="text-xs text-gray-400">{{ $admin->created_at->format('H:i') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="{{ route('admin.management.show', $admin->id) }}" 
                           class="text-green-600 hover:text-green-900 inline-flex items-center"
                           title="Lihat Detail">
                           <i class="fas fa-eye mr-1"></i>
                        </a>
                        <a href="{{ route('admin.management.edit', $admin->id) }}" 
                           class="text-blue-600 hover:text-blue-900 inline-flex items-center"
                           title="Edit">
                           <i class="fas fa-edit mr-1"></i>
                        </a>
                        
                        @if($admin->id !== auth()->guard('admin')->id())
                            <form action="{{ route('admin.management.updateStatus', $admin->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" 
                                        class="text-orange-600 hover:text-orange-900 inline-flex items-center"
                                        title="{{ $admin->is_active ? 'Nonaktifkan' : 'Aktifkan' }}"
                                        onclick="return confirm('Apakah Anda yakin ingin {{ $admin->is_active ? 'menonaktifkan' : 'mengaktifkan' }} admin ini?')">
                                    <i class="fas {{ $admin->is_active ? 'fa-toggle-on' : 'fa-toggle-off' }} mr-1"></i>
                                </button>
                            </form>
                            
                            <form action="{{ route('admin.management.destroy', $admin->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-900 inline-flex items-center"
                                        title="Hapus"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus admin ini?')">
                                    <i class="fas fa-trash mr-1"></i>
                                </button>
                            </form>
                        @else
                            <span class="text-gray-400 text-sm" title="Akun sendiri">
                                <i class="fas fa-user mr-1"></i>
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                        <i class="fas fa-users mr-2"></i>Tidak ada data admin.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Info Panel -->
    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
        <div class="flex items-center text-sm text-gray-600">
            <i class="fas fa-info-circle mr-2 text-blue-500"></i>
            <span>
                Super Admin dapat menambahkan admin baru (baik Super Admin maupun Admin Biasa) dan mengelola semua akun admin.
            </span>
        </div>
    </div>
</div>
@endsection