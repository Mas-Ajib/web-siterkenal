<!-- resources/views/admin/layanan/ppid/edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit Data PPID')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.layanan.ppid.index') }}" 
       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-150">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Edit Data Permohonan PPID</h3>
    </div>
    
    <div class="p-6">
        <form action="{{ route('admin.layanan.ppid.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Pemohon -->
                <div>
                    <label for="nama_pemohon" class="block text-sm font-medium text-gray-700 mb-2">Nama Pemohon</label>
                    <input type="text" id="nama_pemohon" name="nama_pemohon" 
                           value="{{ old('nama_pemohon', $item->nama_pemohon) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('nama_pemohon')
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

                <!-- Nomor Handphone -->
                <div>
                    <label for="nomor_handphone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Handphone</label>
                    <input type="text" id="nomor_handphone" name="nomor_handphone" 
                           value="{{ old('nomor_handphone', $item->nomor_handphone) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('nomor_handphone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="status" name="status" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="processed" {{ $item->status == 'processed' ? 'selected' : '' }}>Diproses</option>
                        <option value="completed" {{ $item->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="rejected" {{ $item->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat -->
                <div class="md:col-span-2">
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              required>{{ old('alamat', $item->alamat) }}</textarea>
                    @error('alamat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Informasi Dibutuhkan -->
                <div class="md:col-span-2">
                    <label for="informasi_dibutuhkan" class="block text-sm font-medium text-gray-700 mb-2">Informasi yang Dibutuhkan</label>
                    <textarea id="informasi_dibutuhkan" name="informasi_dibutuhkan" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              required>{{ old('informasi_dibutuhkan', $item->informasi_dibutuhkan) }}</textarea>
                    @error('informasi_dibutuhkan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alasan Meminta -->
                <div class="md:col-span-2">
                    <label for="alasan_meminta" class="block text-sm font-medium text-gray-700 mb-2">Alasan Meminta Informasi</label>
                    <textarea id="alasan_meminta" name="alasan_meminta" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              required>{{ old('alasan_meminta', $item->alasan_meminta) }}</textarea>
                    @error('alasan_meminta')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cara Memperoleh -->
                <div>
                    <label for="cara_memperoleh" class="block text-sm font-medium text-gray-700 mb-2">Cara Memperoleh Informasi</label>
                    <select id="cara_memperoleh" name="cara_memperoleh" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="soft_copy" {{ $item->cara_memperoleh == 'soft_copy' ? 'selected' : '' }}>Soft Copy</option>
                        <option value="hard_copy" {{ $item->cara_memperoleh == 'hard_copy' ? 'selected' : '' }}>Hard Copy</option>
                        <option value="melihat" {{ $item->cara_memperoleh == 'melihat' ? 'selected' : '' }}>Melihat Langsung</option>
                    </select>
                    @error('cara_memperoleh')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cara Mengirim -->
                <div>
                    <label for="cara_mengirim" class="block text-sm font-medium text-gray-700 mb-2">Cara Mengirim Informasi</label>
                    <select id="cara_mengirim" name="cara_mengirim" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="email" {{ $item->cara_mengirim == 'email' ? 'selected' : '' }}>Email</option>
                        <option value="pos" {{ $item->cara_mengirim == 'pos' ? 'selected' : '' }}>Pos</option>
                        <option value="ambil_langsung" {{ $item->cara_mengirim == 'ambil_langsung' ? 'selected' : '' }}>Ambil Langsung</option>
                    </select>
                    @error('cara_mengirim')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('admin.layanan.ppid.index') }}" 
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