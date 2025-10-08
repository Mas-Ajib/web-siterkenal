<!-- resources/views/admin/layanan/kegiatan/tat.blade.php -->
@extends('layouts.admin')

@section('title', 'TAT - Tes Amphetamine')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-900">TAT - Tes Amphetamine Type Stimulants</h1>
    <div class="flex space-x-3">
        <a href="{{ url('/admin/layanan/kegiatan/tat/export') }}" 
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
                <i class="fas fa-file-alt text-blue-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Total Kasus</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total'] }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-red-100 rounded-lg">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Hasil Positif</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['positif'] }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-green-100 rounded-lg">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Hasil Negatif</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['negatif'] }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-purple-100 rounded-lg">
                <i class="fas fa-weight-hanging text-purple-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Total Berat BB</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_berat'] }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Data Tes Amphetamine (TAT)</h3>
            <span class="text-sm text-gray-500">{{ $data->count() }} data ditemukan</span>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instansi Pemohon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Tersangka</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Penangkapan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Barang Bukti</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Berat Barang Bukti</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hasil Urine</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($data as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $item->instansi_pemohon }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $item->nama_tersangka }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $item->tanggal_penangkapan_indo }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500">
                        {{ $item->jenis_barang_bukti }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">
                            {{ $item->berat_barang_bukti }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($item->hasil_urine == 'Positif')
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                Positif
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                Negatif
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ url('/admin/layanan/kegiatan/tat/' . $item->id . '/edit') }}" 
                           class="text-blue-600 hover:text-blue-900 mr-3">
                           <i class="fas fa-edit mr-1"></i>Edit
                        </a>
                        <form action="{{ url('/admin/layanan/kegiatan/tat/' . $item->id) }}" method="POST" class="inline">
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
                    <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                        <i class="fas fa-inbox mr-2"></i>Tidak ada data TAT.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection