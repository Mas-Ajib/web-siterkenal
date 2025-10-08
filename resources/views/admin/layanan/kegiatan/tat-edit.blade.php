<!-- resources/views/admin/layanan/kegiatan/tat-edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit Data TAT')

@section('content')
<div class="mb-6">
    <a href="{{ url('/admin/layanan/kegiatan/tat') }}" 
       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-150">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Edit Data TAT</h3>
    </div>
    
    <div class="p-6">
        <form action="{{ url('/admin/layanan/kegiatan/tat/' . $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Instansi Pemohon -->
                <div>
                    <label for="instansi_pemohon" class="block text-sm font-medium text-gray-700 mb-2">Instansi Pemohon</label>
                    <input type="text" id="instansi_pemohon" name="instansi_pemohon" 
                           value="{{ old('instansi_pemohon', $item->instansi_pemohon) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('instansi_pemohon')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Tersangka -->
                <div>
                    <label for="nama_tersangka" class="block text-sm font-medium text-gray-700 mb-2">Nama Tersangka</label>
                    <input type="text" id="nama_tersangka" name="nama_tersangka" 
                           value="{{ old('nama_tersangka', $item->nama_tersangka) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('nama_tersangka')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal Penangkapan -->
                <div>
                    <label for="tanggal_penangkapan" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Penangkapan</label>
                    <input type="date" id="tanggal_penangkapan" name="tanggal_penangkapan" 
                           value="{{ old('tanggal_penangkapan', $item->tanggal_penangkapan->format('Y-m-d')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('tanggal_penangkapan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Hasil Urine -->
                <div>
                    <label for="hasil_urine" class="block text-sm font-medium text-gray-700 mb-2">Hasil Urine</label>
                    <select id="hasil_urine" name="hasil_urine" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        <option value="Positif" {{ $item->hasil_urine == 'Positif' ? 'selected' : '' }}>Positif</option>
                        <option value="Negatif" {{ $item->hasil_urine == 'Negatif' ? 'selected' : '' }}>Negatif</option>
                    </select>
                    @error('hasil_urine')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jenis Barang Bukti -->
                <div>
                    <label for="jenis_barang_bukti" class="block text-sm font-medium text-gray-700 mb-2">Jenis Barang Bukti</label>
                    <input type="text" id="jenis_barang_bukti" name="jenis_barang_bukti" 
                           value="{{ old('jenis_barang_bukti', $item->jenis_barang_bukti) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('jenis_barang_bukti')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Berat Barang Bukti -->
                <div>
                    <label for="berat_barang_bukti" class="block text-sm font-medium text-gray-700 mb-2">Berat Barang Bukti</label>
                    <input type="text" id="berat_barang_bukti" name="berat_barang_bukti" 
                           value="{{ old('berat_barang_bukti', $item->berat_barang_bukti) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Contoh: 5 gram" required>
                    @error('berat_barang_bukti')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ url('/admin/layanan/kegiatan/tat') }}" 
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