<!-- resources/views/admin/layanan/pengaduan/narkoba-edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit Data Pelaporan Narkoba')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.layanan.pengaduan.narkoba') }}" 
       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-150">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Edit Data Pelaporan Narkoba</h3>
    </div>
    
    <div class="p-6">
        <form action="{{ route('admin.layanan.pengaduan.narkoba.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Data Pelapor -->
                <div class="md:col-span-2">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Data Pelapor</h4>
                </div>

                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Pelapor</label>
                    <input type="text" id="nama" name="nama" 
                           value="{{ old('nama', $item->nama) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Kosongkan untuk anonim">
                    @error('nama')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                    <input type="text" id="telepon" name="telepon" 
                           value="{{ old('telepon', $item->telepon) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Nomor telepon">
                    @error('telepon')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tempat Kejadian -->
                <div class="md:col-span-2">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Lokasi Kejadian</h4>
                </div>

                <div class="md:col-span-2">
                    <label for="tempat_kejadian" class="block text-sm font-medium text-gray-700 mb-2">Tempat Kejadian *</label>
                    <textarea id="tempat_kejadian" name="tempat_kejadian" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Deskripsikan lokasi kejadian secara detail"
                              required>{{ old('tempat_kejadian', $item->tempat_kejadian) }}</textarea>
                    @error('tempat_kejadian')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Keterangan -->
                <div class="md:col-span-2">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Keterangan Kejadian</h4>
                </div>

                <div class="md:col-span-2">
                    <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan *</label>
                    <textarea id="keterangan" name="keterangan" rows="6"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Jelaskan secara detail tentang kejadian penyalahgunaan narkoba yang dilaporkan"
                              required>{{ old('keterangan', $item->keterangan) }}</textarea>
                    @error('keterangan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
                <a href="{{ route('admin.layanan.pengaduan.narkoba') }}" 
                   class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition duration-150">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-150">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection