<!-- resources/views/admin/layanan/pengaduan/kritiksaran-edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit Data Kritik dan Saran')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.layanan.pengaduan.kritiksaran') }}" 
       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-150">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Edit Data Kritik dan Saran</h3>
    </div>
    
    <div class="p-6">
        <form action="{{ route('admin.layanan.pengaduan.kritiksaran.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Data Pengirim -->
                <div class="md:col-span-2">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Data Pengirim</h4>
                </div>

                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Pengirim</label>
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

                <!-- Kritik -->
                <div class="md:col-span-2">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Kritik</h4>
                </div>

                <div class="md:col-span-2">
                    <label for="kritik" class="block text-sm font-medium text-gray-700 mb-2">Kritik</label>
                    <textarea id="kritik" name="kritik" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Masukkan kritik yang membangun">{{ old('kritik', $item->kritik) }}</textarea>
                    @error('kritik')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Saran -->
                <div class="md:col-span-2">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Saran</h4>
                </div>

                <div class="md:col-span-2">
                    <label for="saran" class="block text-sm font-medium text-gray-700 mb-2">Saran</label>
                    <textarea id="saran" name="saran" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Masukkan saran perbaikan">{{ old('saran', $item->saran) }}</textarea>
                    @error('saran')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pengaduan Layanan -->
                <div class="md:col-span-2">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Pengaduan Layanan</h4>
                </div>

                <div class="md:col-span-2">
                    <label for="pengaduan_layanan" class="block text-sm font-medium text-gray-700 mb-2">Pengaduan Layanan</label>
                    <textarea id="pengaduan_layanan" name="pengaduan_layanan" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Masukkan pengaduan mengenai layanan">{{ old('pengaduan_layanan', $item->pengaduan_layanan) }}</textarea>
                    @error('pengaduan_layanan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
                <a href="{{ route('admin.layanan.pengaduan.kritiksaran') }}" 
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