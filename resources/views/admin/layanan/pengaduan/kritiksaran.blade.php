<!-- resources/views/admin/layanan/pengaduan/kritiksaran.blade.php -->
@extends('layouts.admin')

@section('title', 'Kritik, Saran dan Pengaduan Layanan')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-900">Kritik, Saran dan Pengaduan Layanan</h1>
    <div class="flex space-x-3">
        <a href="{{ route('admin.layanan.pengaduan.kritiksaran.export') }}" 
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
                <h3 class="text-sm font-medium text-gray-500">Total Masukan</h3>
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
                <i class="fas fa-user-secret text-orange-600 text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium text-gray-500">Anonim</h3>
                <p class="text-2xl font-semibold text-gray-900">{{ $stats['anonim'] }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <div class="flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Data Kritik, Saran dan Pengaduan Layanan</h3>
            <span class="text-sm text-gray-500">{{ $data->count() }} data ditemukan</span>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pengirim</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telepon</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kritik</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Saran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengaduan Layanan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kirim</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($data as $index => $item)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        {{ $item->nama ?? 'Anonim' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $item->telepon ?? '-' }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 max-w-xs">
                        @if($item->kritik)
                            <div class="truncate" title="{{ $item->kritik }}">
                                {{ Str::limit($item->kritik, 50) }}
                            </div>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 max-w-xs">
                        @if($item->saran)
                            <div class="truncate" title="{{ $item->saran }}">
                                {{ Str::limit($item->saran, 50) }}
                            </div>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 max-w-xs">
                        @if($item->pengaduan_layanan)
                            <div class="truncate" title="{{ $item->pengaduan_layanan }}">
                                {{ Str::limit($item->pengaduan_layanan, 50) }}
                            </div>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $item->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                        <a href="{{ route('admin.layanan.pengaduan.kritiksaran.edit', $item->id) }}" 
                           class="text-blue-600 hover:text-blue-900 inline-flex items-center">
                           <i class="fas fa-edit mr-1"></i>Edit
                        </a>
                        <form action="{{ route('admin.layanan.pengaduan.kritiksaran.destroy', $item->id) }}" method="POST" class="inline">
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
                    <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                        <i class="fas fa-inbox mr-2"></i>Tidak ada data kritik dan saran.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection