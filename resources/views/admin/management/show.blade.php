<!-- resources/views/admin/management/show.blade.php -->
@extends('layouts.admin')

@section('title', 'Detail Admin')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.management.index') }}" 
       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-150">
        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
    </a>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Detail Admin</h3>
    </div>
    
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Informasi Admin -->
            <div class="space-y-6">
                <h4 class="text-lg font-semibold text-gray-900 border-b pb-2">Informasi Admin</h4>
                
                <div class="flex items-center space-x-4">
                    <div class="h-16 w-16 rounded-full bg-blue-100 flex items-center justify-center">
                        <span class="text-blue-600 font-semibold text-xl">
                            {{ strtoupper(substr($admin->name, 0, 2)) }}
                        </span>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">{{ $admin->name }}</h3>
                        <p class="text-sm text-gray-500">ID: {{ $admin->id }}</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $admin->email }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Role</label>
                        <p class="mt-1">
                            @if($admin->role == 'superadmin')
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                    <i class="fas fa-crown mr-1"></i>Super Admin
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-user-shield mr-1"></i>Admin Biasa
                                </span>
                            @endif
                        </p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <p class="mt-1">
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                                {{ $admin->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $admin->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Informasi Sistem -->
            <div class="space-y-6">
                <h4 class="text-lg font-semibold text-gray-900 border-b pb-2">Informasi Sistem</h4>
                
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal Dibuat</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $admin->created_at->format('d F Y H:i') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Terakhir Diupdate</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $admin->updated_at->format('d F Y H:i') }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Login Terakhir</label>
                        <p class="mt-1 text-sm text-gray-900">
                            @if($admin->last_login_at)
                                {{ \Carbon\Carbon::parse($admin->last_login_at)->format('d F Y H:i') }}
                            @else
                                <span class="text-gray-400">Belum pernah login</span>
                            @endif
                        </p>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="pt-4 space-x-3">
                    <a href="{{ route('admin.management.edit', $admin->id) }}" 
                       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-150 inline-flex items-center">
                       <i class="fas fa-edit mr-2"></i>Edit Admin
                    </a>
                    
                    @if($admin->id !== auth()->guard('admin')->id())
                        <a href="{{ route('admin.management.index') }}" 
                           class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-150 inline-flex items-center">
                           <i class="fas fa-list mr-2"></i>Kembali ke Daftar
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection