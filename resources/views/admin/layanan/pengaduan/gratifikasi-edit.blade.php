<!-- resources/views/admin/layanan/pengaduan/gratifikasi-edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit Data Gratifikasi')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.layanan.pengaduan.gratifikasi') }}" 
       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-150">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Edit Data Pelaporan Gratifikasi</h3>
    </div>
    
    <div class="p-6">
        <form action="{{ route('admin.layanan.pengaduan.gratifikasi.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Data Pribadi -->
                <div class="md:col-span-2">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Data Pribadi</h4>
                </div>

                <div>
                    <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" 
                           value="{{ old('nama_lengkap', $item->nama_lengkap) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('nama_lengkap')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">NIK *</label>
                    <input type="text" id="nik" name="nik" 
                           value="{{ old('nik', $item->nik) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required maxlength="16">
                    @error('nik')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir *</label>
                    <input type="text" id="tempat_lahir" name="tempat_lahir" 
                           value="{{ old('tempat_lahir', $item->tempat_lahir) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('tempat_lahir')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir *</label>
                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" 
                           value="{{ old('tanggal_lahir', $item->tanggal_lahir->format('Y-m-d')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('tanggal_lahir')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-2">Jabatan *</label>
                    <input type="text" id="jabatan" name="jabatan" 
                           value="{{ old('jabatan', $item->jabatan) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('jabatan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nama_instansi" class="block text-sm font-medium text-gray-700 mb-2">Nama Instansi *</label>
                    <input type="text" id="nama_instansi" name="nama_instansi" 
                           value="{{ old('nama_instansi', $item->nama_instansi) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('nama_instansi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="unit_kerja" class="block text-sm font-medium text-gray-700 mb-2">Unit Kerja *</label>
                    <input type="text" id="unit_kerja" name="unit_kerja" 
                           value="{{ old('unit_kerja', $item->unit_kerja) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('unit_kerja')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" id="email" name="email" 
                           value="{{ old('email', $item->email) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="no_seluler" class="block text-sm font-medium text-gray-700 mb-2">No. Seluler *</label>
                    <input type="text" id="no_seluler" name="no_seluler" 
                           value="{{ old('no_seluler', $item->no_seluler) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('no_seluler')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="no_rumah" class="block text-sm font-medium text-gray-700 mb-2">No. Rumah</label>
                    <input type="text" id="no_rumah" name="no_rumah" 
                           value="{{ old('no_rumah', $item->no_rumah) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('no_rumah')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="no_kantor" class="block text-sm font-medium text-gray-700 mb-2">No. Kantor</label>
                    <input type="text" id="no_kantor" name="no_kantor" 
                           value="{{ old('no_kantor', $item->no_kantor) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('no_kantor')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="alamat_kantor" class="block text-sm font-medium text-gray-700 mb-2">Alamat Kantor *</label>
                    <textarea id="alamat_kantor" name="alamat_kantor" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              required>{{ old('alamat_kantor', $item->alamat_kantor) }}</textarea>
                    @error('alamat_kantor')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="alamat_pengiriman" class="block text-sm font-medium text-gray-700 mb-2">Alamat Pengiriman *</label>
                    <textarea id="alamat_pengiriman" name="alamat_pengiriman" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              required>{{ old('alamat_pengiriman', $item->alamat_pengiriman) }}</textarea>
                    @error('alamat_pengiriman')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Data Penerimaan -->
                <div class="md:col-span-2">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Data Penerimaan</h4>
                </div>

                <div class="md:col-span-2">
                    <label for="jenis_penerimaan" class="block text-sm font-medium text-gray-700 mb-2">Jenis Penerimaan *</label>
                    <input type="text" id="jenis_penerimaan" name="jenis_penerimaan" 
                           value="{{ old('jenis_penerimaan', $item->jenis_penerimaan) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('jenis_penerimaan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nilai_nominal" class="block text-sm font-medium text-gray-700 mb-2">Nilai Nominal (Rp) *</label>
                    <input type="number" id="nilai_nominal" name="nilai_nominal" step="0.01"
                           value="{{ old('nilai_nominal', $item->nilai_nominal) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('nilai_nominal')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tanggal_penerimaan" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Penerimaan *</label>
                    <input type="date" id="tanggal_penerimaan" name="tanggal_penerimaan" 
                           value="{{ old('tanggal_penerimaan', $item->tanggal_penerimaan->format('Y-m-d')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('tanggal_penerimaan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="tempat_penerimaan" class="block text-sm font-medium text-gray-700 mb-2">Tempat Penerimaan *</label>
                    <input type="text" id="tempat_penerimaan" name="tempat_penerimaan" 
                           value="{{ old('tempat_penerimaan', $item->tempat_penerimaan) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('tempat_penerimaan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="peristiwa_penerimaan" class="block text-sm font-medium text-gray-700 mb-2">Peristiwa Penerimaan *</label>
                    <textarea id="peristiwa_penerimaan" name="peristiwa_penerimaan" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              required>{{ old('peristiwa_penerimaan', $item->peristiwa_penerimaan) }}</textarea>
                    @error('peristiwa_penerimaan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Data Pemberi -->
                <div class="md:col-span-2">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Data Pemberi</h4>
                </div>

                <div>
                    <label for="nama_pemberi" class="block text-sm font-medium text-gray-700 mb-2">Nama Pemberi *</label>
                    <input type="text" id="nama_pemberi" name="nama_pemberi" 
                           value="{{ old('nama_pemberi', $item->nama_pemberi) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('nama_pemberi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="pekerjaan_jabatan_pemberi" class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan/Jabatan Pemberi *</label>
                    <input type="text" id="pekerjaan_jabatan_pemberi" name="pekerjaan_jabatan_pemberi" 
                           value="{{ old('pekerjaan_jabatan_pemberi', $item->pekerjaan_jabatan_pemberi) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('pekerjaan_jabatan_pemberi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="hubungan_dengan_pemberi" class="block text-sm font-medium text-gray-700 mb-2">Hubungan dengan Pemberi *</label>
                    <input type="text" id="hubungan_dengan_pemberi" name="hubungan_dengan_pemberi" 
                           value="{{ old('hubungan_dengan_pemberi', $item->hubungan_dengan_pemberi) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('hubungan_dengan_pemberi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="alamat_pemberi" class="block text-sm font-medium text-gray-700 mb-2">Alamat Pemberi *</label>
                    <textarea id="alamat_pemberi" name="alamat_pemberi" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              required>{{ old('alamat_pemberi', $item->alamat_pemberi) }}</textarea>
                    @error('alamat_pemberi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="telepon_pemberi" class="block text-sm font-medium text-gray-700 mb-2">Telepon Pemberi</label>
                    <input type="text" id="telepon_pemberi" name="telepon_pemberi" 
                           value="{{ old('telepon_pemberi', $item->telepon_pemberi) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('telepon_pemberi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email_pemberi" class="block text-sm font-medium text-gray-700 mb-2">Email Pemberi</label>
                    <input type="email" id="email_pemberi" name="email_pemberi" 
                           value="{{ old('email_pemberi', $item->email_pemberi) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('email_pemberi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alasan dan Kronologi -->
                <div class="md:col-span-2">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Alasan & Kronologi</h4>
                </div>

                <div class="md:col-span-2">
                    <label for="alasan_pemberian" class="block text-sm font-medium text-gray-700 mb-2">Alasan Pemberian *</label>
                    <textarea id="alasan_pemberian" name="alasan_pemberian" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              required>{{ old('alasan_pemberian', $item->alasan_pemberian) }}</textarea>
                    @error('alasan_pemberian')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="kronologi_penerimaan" class="block text-sm font-medium text-gray-700 mb-2">Kronologi Penerimaan *</label>
                    <textarea id="kronologi_penerimaan" name="kronologi_penerimaan" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              required>{{ old('kronologi_penerimaan', $item->kronologi_penerimaan) }}</textarea>
                    @error('kronologi_penerimaan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="link_dokumen" class="block text-sm font-medium text-gray-700 mb-2">Link Dokumen</label>
                    <input type="url" id="link_dokumen" name="link_dokumen" 
                           value="{{ old('link_dokumen', $item->link_dokumen) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="https://...">
                    @error('link_dokumen')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="catatan_tambahan" class="block text-sm font-medium text-gray-700 mb-2">Catatan Tambahan</label>
                    <textarea id="catatan_tambahan" name="catatan_tambahan" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('catatan_tambahan', $item->catatan_tambahan) }}</textarea>
                    @error('catatan_tambahan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="bersedia_kompensasi" class="block text-sm font-medium text-gray-700 mb-2">Bersedia Kompensasi *</label>
                    <select id="bersedia_kompensasi" name="bersedia_kompensasi" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        <option value="1" {{ old('bersedia_kompensasi', $item->bersedia_kompensasi) ? 'selected' : '' }}>Ya</option>
                        <option value="0" {{ !old('bersedia_kompensasi', $item->bersedia_kompensasi) ? 'selected' : '' }}>Tidak</option>
                    </select>
                    @error('bersedia_kompensasi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
                <a href="{{ route('admin.layanan.pengaduan.gratifikasi') }}" 
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