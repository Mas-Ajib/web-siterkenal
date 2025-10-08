<!-- resources/views/admin/layanan/kegiatan/tes-urine-edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit Tes Urine Mandiri')

@section('content')
<div class="mb-6">
    <a href="{{ url('/admin/layanan/kegiatan/tes-urine') }}" 
       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-150">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Edit Data Tes Urine Mandiri</h3>
    </div>
    
    <div class="p-6">
        <form action="{{ url('/admin/layanan/kegiatan/tes-urine/' . $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Jenis Tes -->
                <div>
                    <label for="jenis_tes" class="block text-sm font-medium text-gray-700 mb-2">Jenis Tes</label>
                    <select id="jenis_tes" name="jenis_tes" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        <option value="Masyarakat" {{ $item->jenis_tes == 'Masyarakat' ? 'selected' : '' }}>Masyarakat Umum</option>
                        <option value="Pemerintah" {{ $item->jenis_tes == 'Pemerintah' ? 'selected' : '' }}>Instansi Pemerintah</option>
                        <option value="Swasta" {{ $item->jenis_tes == 'Swasta' ? 'selected' : '' }}>Perusahaan Swasta</option>
                        <option value="Pendidikan" {{ $item->jenis_tes == 'Pendidikan' ? 'selected' : '' }}>Lembaga Pendidikan</option>
                    </select>
                    @error('jenis_tes')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Penyelenggara -->
                <div>
                    <label for="nama_penyelenggara" class="block text-sm font-medium text-gray-700 mb-2">Nama Penyelenggara</label>
                    <input type="text" id="nama_penyelenggara" name="nama_penyelenggara" 
                           value="{{ old('nama_penyelenggara', $item->nama_penyelenggara) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('nama_penyelenggara')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal -->
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" 
                           value="{{ old('tanggal', $item->tanggal->format('Y-m-d')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('tanggal')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Waktu -->
                <div>
                    <label for="waktu" class="block text-sm font-medium text-gray-700 mb-2">Waktu</label>
                    <input type="time" id="waktu" name="waktu" 
                           value="{{ old('waktu', $item->waktu) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('waktu')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tempat -->
                <div class="md:col-span-2">
                    <label for="tempat" class="block text-sm font-medium text-gray-700 mb-2">Tempat</label>
                    <input type="text" id="tempat" name="tempat" 
                           value="{{ old('tempat', $item->tempat) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('tempat')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Penanggung Jawab -->
                <div>
                    <label for="nama_penanggung_jawab" class="block text-sm font-medium text-gray-700 mb-2">Nama Penanggung Jawab</label>
                    <input type="text" id="nama_penanggung_jawab" name="nama_penanggung_jawab" 
                           value="{{ old('nama_penanggung_jawab', $item->nama_penanggung_jawab) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('nama_penanggung_jawab')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- No HP Penanggung Jawab -->
                <div>
                    <label for="nohp_penanggung_jawab" class="block text-sm font-medium text-gray-700 mb-2">No HP Penanggung Jawab</label>
                    <input type="text" id="nohp_penanggung_jawab" name="nohp_penanggung_jawab" 
                           value="{{ old('nohp_penanggung_jawab', $item->nohp_penanggung_jawab) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('nohp_penanggung_jawab')
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

                <!-- Keterangan -->
                <div class="md:col-span-2">
                    <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                    <textarea id="keterangan" name="keterangan" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Keterangan tambahan...">{{ old('keterangan', $item->keterangan) }}</textarea>
                    @error('keterangan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ url('/admin/layanan/kegiatan/tes-urine') }}" 
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