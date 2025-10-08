<!-- resources/views/admin/layanan/pengaduan/whistleblowing-edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit Data Whistle Blowing')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.layanan.pengaduan.whistleblowing') }}" 
       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition duration-150">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Edit Data Whistle Blowing</h3>
    </div>
    
    <div class="p-6">
        <form action="{{ route('admin.layanan.pengaduan.whistleblowing.update', $item->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Data Pelapor -->
                <div class="md:col-span-2">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Data Pelapor</h4>
                </div>

                <div>
                    <label for="jenis_pelanggaran" class="block text-sm font-medium text-gray-700 mb-2">Jenis Pelanggaran *</label>
                    <select id="jenis_pelanggaran" name="jenis_pelanggaran" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                        <option value="">Pilih Jenis Pelanggaran</option>
                        <option value="Korupsi" {{ old('jenis_pelanggaran', $item->jenis_pelanggaran) == 'Korupsi' ? 'selected' : '' }}>Korupsi</option>
                        <option value="Suap" {{ old('jenis_pelanggaran', $item->jenis_pelanggaran) == 'Suap' ? 'selected' : '' }}>Suap</option>
                        <option value="Penggelapan" {{ old('jenis_pelanggaran', $item->jenis_pelanggaran) == 'Penggelapan' ? 'selected' : '' }}>Penggelapan</option>
                        <option value="Pemalsuan" {{ old('jenis_pelanggaran', $item->jenis_pelanggaran) == 'Pemalsuan' ? 'selected' : '' }}>Pemalsuan</option>
                        <option value="Gratifikasi" {{ old('jenis_pelanggaran', $item->jenis_pelanggaran) == 'Gratifikasi' ? 'selected' : '' }}>Gratifikasi</option>
                        <option value="Konflik Kepentingan" {{ old('jenis_pelanggaran', $item->jenis_pelanggaran) == 'Konflik Kepentingan' ? 'selected' : '' }}>Konflik Kepentingan</option>
                        <option value="Penyalahgunaan Wewenang" {{ old('jenis_pelanggaran', $item->jenis_pelanggaran) == 'Penyalahgunaan Wewenang' ? 'selected' : '' }}>Penyalahgunaan Wewenang</option>
                        <option value="Lainnya" {{ old('jenis_pelanggaran', $item->jenis_pelanggaran) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('jenis_pelanggaran')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div id="jenis_lainnya_container" style="{{ old('jenis_pelanggaran', $item->jenis_pelanggaran) == 'Lainnya' ? '' : 'display: none;' }}">
                    <label for="jenis_pelanggaran_lainnya" class="block text-sm font-medium text-gray-700 mb-2">Jenis Pelanggaran Lainnya</label>
                    <input type="text" id="jenis_pelanggaran_lainnya" name="jenis_pelanggaran_lainnya" 
                           value="{{ old('jenis_pelanggaran_lainnya', $item->jenis_pelanggaran_lainnya) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Jenis pelanggaran lainnya">
                    @error('jenis_pelanggaran_lainnya')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nama_pelapor" class="block text-sm font-medium text-gray-700 mb-2">Nama Pelapor</label>
                    <input type="text" id="nama_pelapor" name="nama_pelapor" 
                           value="{{ old('nama_pelapor', $item->nama_pelapor) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Kosongkan untuk anonim">
                    @error('nama_pelapor')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" 
                           value="{{ old('email', $item->email) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Lokasi Kejadian -->
                <div class="md:col-span-2">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Lokasi Kejadian</h4>
                </div>

                <div class="md:col-span-2">
                    <label for="lokasi_kejadian" class="block text-sm font-medium text-gray-700 mb-2">Lokasi Kejadian *</label>
                    <input type="text" id="lokasi_kejadian" name="lokasi_kejadian" 
                           value="{{ old('lokasi_kejadian', $item->lokasi_kejadian) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('lokasi_kejadian')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="kota_kabupaten" class="block text-sm font-medium text-gray-700 mb-2">Kota/Kabupaten *</label>
                    <input type="text" id="kota_kabupaten" name="kota_kabupaten" 
                           value="{{ old('kota_kabupaten', $item->kota_kabupaten) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('kota_kabupaten')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="provinsi" class="block text-sm font-medium text-gray-700 mb-2">Provinsi *</label>
                    <input type="text" id="provinsi" name="provinsi" 
                           value="{{ old('provinsi', $item->provinsi) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('provinsi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Waktu Kejadian -->
                <div class="md:col-span-2">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Waktu Kejadian</h4>
                </div>

                <div>
                    <label for="tanggal_kejadian" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Kejadian *</label>
                    <input type="date" id="tanggal_kejadian" name="tanggal_kejadian" 
                           value="{{ old('tanggal_kejadian', $item->tanggal_kejadian->format('Y-m-d')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           required>
                    @error('tanggal_kejadian')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="waktu_kejadian" class="block text-sm font-medium text-gray-700 mb-2">Waktu Kejadian</label>
                    <input type="time" id="waktu_kejadian" name="waktu_kejadian" 
                           value="{{ old('waktu_kejadian', $item->waktu_kejadian) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    @error('waktu_kejadian')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Uraian Pengaduan -->
                <div class="md:col-span-2">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Uraian Pengaduan</h4>
                </div>

                <div class="md:col-span-2">
                    <label for="uraian_pengaduan" class="block text-sm font-medium text-gray-700 mb-2">Uraian Pengaduan *</label>
                    <textarea id="uraian_pengaduan" name="uraian_pengaduan" rows="6"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                              required>{{ old('uraian_pengaduan', $item->uraian_pengaduan) }}</textarea>
                    @error('uraian_pengaduan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pernyataan -->
                <div class="md:col-span-2">
                    <div class="flex items-center">
                        <input type="checkbox" id="pernyataan" name="pernyataan" value="1"
                               {{ old('pernyataan', $item->pernyataan) ? 'checked' : '' }}
                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        <label for="pernyataan" class="ml-2 text-sm font-medium text-gray-700">
                            Saya menyatakan bahwa informasi yang saya berikan adalah benar *
                        </label>
                    </div>
                    @error('pernyataan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end space-x-3">
                <a href="{{ route('admin.layanan.pengaduan.whistleblowing') }}" 
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const jenisPelanggaran = document.getElementById('jenis_pelanggaran');
    const jenisLainnyaContainer = document.getElementById('jenis_lainnya_container');
    
    function toggleJenisLainnya() {
        if (jenisPelanggaran.value === 'Lainnya') {
            jenisLainnyaContainer.style.display = 'block';
        } else {
            jenisLainnyaContainer.style.display = 'none';
        }
    }
    
    jenisPelanggaran.addEventListener('change', toggleJenisLainnya);
    toggleJenisLainnya(); // Initial check
});
</script>
@endsection