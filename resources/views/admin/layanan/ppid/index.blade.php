<!-- resources/views/admin/layanan/ppid/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Layanan Informasi PPID')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-900">Layanan Informasi PPID</h1>
    <div class="flex space-x-3">
        <a href="{{ route('admin.layanan.ppid.export') }}" 
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
                <h3 class="text-sm font-medium text-gray-500">Total Permohonan</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['total'] }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-yellow-100 rounded-lg">
                <i class="fas fa-clock text-yellow-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Menunggu</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['pending'] }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-orange-100 rounded-lg">
                <i class="fas fa-cog text-orange-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Diproses</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['processed'] }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-green-100 rounded-lg">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Selesai</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['completed'] }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Data Permohonan Informasi PPID</h3>
            <span class="text-sm text-gray-500">{{ $data->count() }} data ditemukan</span>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pemohon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Informasi Dibutuhkan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cara Memperoleh</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($data as $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->nama_pemohon }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->nomor_handphone }}</td>
                    <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate" title="{{ $item->informasi_dibutuhkan }}">
                        {{ Str::limit($item->informasi_dibutuhkan, 50) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->cara_memperoleh_text }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($item->status == 'pending')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Menunggu
                            </span>
                        @elseif($item->status == 'processed')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                Diproses
                            </span>
                        @elseif($item->status == 'completed')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Selesai
                            </span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Ditolak
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->created_at->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.layanan.ppid.edit', $item->id) }}" 
                           class="text-blue-600 hover:text-blue-900 mr-3">
                           <i class="fas fa-edit mr-1"></i>Edit
                        </a>
                        <form action="{{ route('admin.layanan.ppid.destroy', $item->id) }}" method="POST" class="inline">
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
                        <i class="fas fa-inbox mr-2"></i>Tidak ada data permohonan informasi PPID.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection