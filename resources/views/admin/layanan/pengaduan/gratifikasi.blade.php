<!-- resources/views/admin/layanan/pengaduan/gratifikasi.blade.php -->
@extends('layouts.admin')

@section('title', 'Pelaporan Gratifikasi')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-900">Pelaporan Gratifikasi</h1>
    <div class="flex space-x-3">
        <a href="{{ route('admin.layanan.pengaduan.gratifikasi.export') }}" 
           class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-150">
            <i class="fas fa-file-excel mr-2"></i>Export Excel
        </a>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-blue-100 rounded-lg">
                <i class="fas fa-inbox text-blue-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Total Laporan</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total'] }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-green-100 rounded-lg">
                <i class="fas fa-calendar-day text-green-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Bulan Ini</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['bulan_ini'] }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-purple-100 rounded-lg">
                <i class="fas fa-calendar-alt text-purple-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Tahun Ini</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['tahun_ini'] }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-orange-100 rounded-lg">
                <i class="fas fa-money-bill-wave text-orange-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Total Nilai</h3>
                <p class="text-2xl font-semibold text-gray-900">Rp {{ number_format($stats['total_nilai'], 0, ',', '.') }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Data Pelaporan Gratifikasi</h3>
            <span class="text-sm text-gray-500">{{ $data->count() }} data ditemukan</span>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instansi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Penerimaan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai Nominal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Penerimaan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dokumen</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($data as $index => $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->nama_lengkap }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->nik }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->jabatan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->nama_instansi }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 max-w-xs truncate">{{ $item->jenis_penerimaan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($item->nilai_nominal, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($item->tanggal_penerimaan)->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if($item->dokumen_path)
                            <a href="{{ asset('storage/dokumen/gratifikasi/' . $item->dokumen_path) }}" target="_blank" 
                               class="text-blue-600 hover:text-blue-900 inline-flex items-center">
                                <i class="fas fa-file-pdf mr-1"></i>Lihat
                            </a>
                        @elseif($item->link_dokumen)
                            <a href="{{ $item->link_dokumen }}" target="_blank" 
                               class="text-green-600 hover:text-green-900 inline-flex items-center">
                                <i class="fas fa-external-link-alt mr-1"></i>Link
                            </a>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="{{ route('admin.layanan.pengaduan.gratifikasi.edit', $item->id) }}" 
                           class="text-blue-600 hover:text-blue-900 inline-flex items-center">
                           <i class="fas fa-edit mr-1"></i>Edit
                        </a>
                        <form action="{{ route('admin.layanan.pengaduan.gratifikasi.destroy', $item->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-900 inline-flex items-center"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <i class="fas fa-trash mr-1"></i>Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="px-6 py-4 text-center text-sm text-gray-500">
                        <i class="fas fa-inbox mr-2"></i>Tidak ada data pelaporan gratifikasi.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection