@extends('layouts.admin')

@section('title', 'Edit Data Magang')

@section('content')
<div class="mb-6">
    <a href="{{ url('/admin/layanan/kegiatan/magang') }}" 
       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-150">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Edit Data Magang</h3>
    </div>
    
    <div class="p-6">
        <!-- Info Lampiran -->
        @if($item->lampiran)
        <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-file-pdf text-blue-600 text-xl mr-3"></i>
                    <div>
                        <h4 class="font-medium text-blue-900">Dokumen Lampiran Tersedia</h4>
                        <p class="text-sm text-blue-700">Dokumen sudah diupload oleh pemohon</p>
                    </div>
                </div>
                <a href="{{ asset('storage/' . $item->lampiran) }}" 
                   target="_blank"
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-150">
                    <i class="fas fa-eye mr-2"></i>Lihat Dokumen
                </a>
            </div>
        </div>
        @else
        <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle text-yellow-600 text-xl mr-3"></i>
                <div>
                    <h4 class="font-medium text-yellow-900">Tidak Ada Lampiran</h4>
                    <p class="text-sm text-yellow-700">Pemohon tidak mengupload dokumen</p>
                </div>
            </div>
        </div>
        @endif

        <form action="{{ url('/admin/layanan/kegiatan/magang/' . $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Lengkap -->
                <div>
                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" 
                           value="{{ old('nama_lengkap', $item->nama_lengkap) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('nama_lengkap')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" 
                           value="{{ old('email', $item->email) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Instansi -->
                <div class="md:col-span-2">
                    <label for="instansi" class="block text-sm font-medium text-gray-700 mb-2">Instansi</label>
                    <input type="text" id="instansi" name="instansi" 
                           value="{{ old('instansi', $item->instansi) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('instansi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Penanggung Jawab -->
                <div>
                    <label for="penanggung_jawab" class="block text-sm font-medium text-gray-700 mb-2">Penanggung Jawab</label>
                    <input type="text" id="penanggung_jawab" name="penanggung_jawab" 
                           value="{{ old('penanggung_jawab', $item->penanggung_jawab) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('penanggung_jawab')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kontak -->
                <div>
                    <label for="kontak" class="block text-sm font-medium text-gray-700 mb-2">Kontak</label>
                    <input type="text" id="kontak" name="kontak" 
                           value="{{ old('kontak', $item->kontak) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('kontak')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jangka Waktu -->
                <div>
                    <label for="jangka_waktu" class="block text-sm font-medium text-gray-700 mb-2">Jangka Waktu (hari)</label>
                    <input type="number" id="jangka_waktu" name="jangka_waktu" 
                           value="{{ old('jangka_waktu', $item->jangka_waktu) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           min="1" required>
                    @error('jangka_waktu')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jumlah Peserta -->
                <div>
                    <label for="jumlah_peserta" class="block text-sm font-medium text-gray-700 mb-2">Jumlah Peserta</label>
                    <input type="number" id="jumlah_peserta" name="jumlah_peserta" 
                           value="{{ old('jumlah_peserta', $item->jumlah_peserta) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           min="1" required>
                    @error('jumlah_peserta')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ url('/admin/layanan/kegiatan/magang') }}" 
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