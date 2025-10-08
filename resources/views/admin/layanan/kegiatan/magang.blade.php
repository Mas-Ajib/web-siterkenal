@extends('layouts.admin')

@section('title', 'Magang')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-900">Kegiatan Magang</h1>
    <div class="flex space-x-3">
        <a href="{{ url('/admin/layanan/kegiatan/magang/export') }}" 
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
                <i class="fas fa-user-graduate text-blue-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Total Permohonan</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total'] ?? 0 }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-green-100 rounded-lg">
                <i class="fas fa-users text-green-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Total Peserta</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_peserta'] ?? 0 }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-purple-100 rounded-lg">
                <i class="fas fa-calendar-alt text-purple-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Rata-rata Waktu</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['rata_rata_waktu'] ?? 0 }} hari</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-orange-100 rounded-lg">
                <i class="fas fa-calendar-check text-orange-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Bulan Ini</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['bulan_ini'] ?? 0 }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Data Permohonan Magang</h3>
            <span class="text-sm text-gray-500">{{ $data->count() }} data ditemukan</span>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instansi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lampiran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jangka Waktu</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Peserta</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($data as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $item->nama_lengkap }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $item->email }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate" title="{{ $item->instansi }}">
                        {{ $item->instansi }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        @if($item->lampiran)
                            <a href="{{ asset('storage/' . $item->lampiran) }}" 
                               target="_blank"
                               class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium hover:bg-blue-200 transition duration-150">
                                <i class="fas fa-file-pdf mr-1"></i>Lihat Dokumen
                            </a>
                        @else
                            <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-500 rounded-full text-xs font-medium">
                                <i class="fas fa-times mr-1"></i>Tidak Ada
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">
                            {{ $item->jangka_waktu }} hari
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                            {{ $item->jumlah_peserta }} orang
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $item->created_at->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ url('/admin/layanan/kegiatan/magang/' . $item->id . '/edit') }}" 
                           class="text-blue-600 hover:text-blue-900 mr-3">
                           <i class="fas fa-edit mr-1"></i>Edit
                        </a>
                        <form action="{{ url('/admin/layanan/kegiatan/magang/' . $item->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-900"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                <i class="fas fa-trash mr-1"></i>Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                        <i class="fas fa-inbox mr-2"></i>Tidak ada data magang.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection