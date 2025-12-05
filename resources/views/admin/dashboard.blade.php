@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <style>
        .stat-card:hover {
            transform: translateY(-2px);
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        
        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }
        
        .growth-positive {
            color: #10B981;
        }
        
        .growth-negative {
            color: #EF4444;
        }
        
        .category-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
        }
        
        .category-badge-pengaduan {
            background-color: #FEE2E2;
            color: #DC2626;
        }
        
        .category-badge-ppid {
            background-color: #DBEAFE;
            color: #1D4ED8;
        }
        
        .category-badge-rehabilitasi {
            background-color: #D1FAE5;
            color: #047857;
        }
        
        .category-badge-kegiatan {
            background-color: #EDE9FE;
            color: #7C3AED;
        }
    </style>

    <!-- Stat Cards - SEMUA 5 KARTU (Total + 4 Layanan) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-6">
        <!-- Total Semua Layanan -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow text-white p-6 stat-card">
            <div class="flex items-center">
                <div class="p-3 bg-blue-400 rounded-lg bg-opacity-20">
                    <i class="fas fa-layer-group text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium opacity-90">Total Semua Layanan</h3>
                    <p class="text-2xl font-semibold">{{ number_format($totalAllLayanan) }}</p>
                    <p class="text-xs opacity-80">4 kategori layanan</p>
                </div>
            </div>
        </div>

        <!-- Layanan Pengaduan -->
        <div class="bg-white rounded-lg shadow p-6 stat-card">
            <div class="flex items-center">
                <div class="p-3 bg-red-100 rounded-lg">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Pengaduan Masyarakat</h3>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['pengaduan']['total']) }}</p>
                    <p class="text-xs {{ $stats['pengaduan']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }}">
                        <i class="fas fa-arrow-{{ $stats['pengaduan']['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                        {{ $stats['pengaduan']['growth'] >= 0 ? '+' : '' }}{{ $stats['pengaduan']['growth'] }}%
                    </p>
                </div>
            </div>
        </div>

        <!-- Layanan PPID -->
        <div class="bg-white rounded-lg shadow p-6 stat-card">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-lg">
                    <i class="fas fa-file-alt text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Layanan PPID</h3>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['ppid']['total']) }}</p>
                    <p class="text-xs {{ $stats['ppid']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }}">
                        <i class="fas fa-arrow-{{ $stats['ppid']['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                        {{ $stats['ppid']['growth'] >= 0 ? '+' : '' }}{{ $stats['ppid']['growth'] }}%
                    </p>
                </div>
            </div>
        </div>

        <!-- Layanan Rehabilitasi -->
        <div class="bg-white rounded-lg shadow p-6 stat-card">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-lg">
                    <i class="fas fa-heartbeat text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Rehabilitasi</h3>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['rehabilitasi']['total']) }}</p>
                    <p class="text-xs {{ $stats['rehabilitasi']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }}">
                        <i class="fas fa-arrow-{{ $stats['rehabilitasi']['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                        {{ $stats['rehabilitasi']['growth'] >= 0 ? '+' : '' }}{{ $stats['rehabilitasi']['growth'] }}%
                    </p>
                </div>
            </div>
        </div>

        <!-- Layanan Kegiatan -->
        <div class="bg-white rounded-lg shadow p-6 stat-card">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 rounded-lg">
                    <i class="fas fa-tasks text-purple-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Layanan Kegiatan</h3>
                    <p class="text-2xl font-semibold text-gray-900">{{ number_format($stats['kegiatan']['total']) }}</p>
                    <p class="text-xs {{ $stats['kegiatan']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }}">
                        <i class="fas fa-arrow-{{ $stats['kegiatan']['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                        {{ $stats['kegiatan']['growth'] >= 0 ? '+' : '' }}{{ $stats['kegiatan']['growth'] }}%
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Chart 1: Total Data -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center mb-4">
                <div class="p-2 bg-blue-100 rounded-lg mr-3">
                    <i class="fas fa-chart-bar text-blue-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Perbandingan Total Semua Layanan</h3>
            </div>
            <div class="chart-container">
                <canvas id="totalChart"></canvas>
            </div>
        </div>

        <!-- Chart 2: Monthly Data -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center mb-4">
                <div class="p-2 bg-green-100 rounded-lg mr-3">
                    <i class="fas fa-chart-pie text-green-600"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900">Distribusi Data Bulan Ini</h3>
            </div>
            <div class="chart-container">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Aktivitas Terbaru</h3>
        </div>
        <div class="p-6">
            <div class="space-y-3">
                @forelse($recentActivities as $activity)
                    <div class="flex items-start p-3 bg-gray-50 rounded-lg border-l-4 border-{{ $activity['color'] }}-400">
                        <div class="p-2 bg-{{ $activity['color'] }}-100 rounded-full mr-3">
                            <i class="fas fa-{{ $activity['icon'] }} text-{{ $activity['color'] }}-600 text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-800">{{ $activity['message'] }}</p>
                            <p class="text-xs text-gray-500">{{ $activity['time'] }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-4 text-gray-500">
                        <i class="fas fa-inbox text-3xl mb-2"></i>
                        <p>Tidak ada aktivitas terbaru</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Detail Cards untuk SEMUA LAYANAN -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Detail Pengaduan -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                    Detail Pengaduan Masyarakat
                    <span class="category-badge category-badge-pengaduan ml-2">4 Jenis</span>
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4">
                    @foreach($stats['pengaduan']['details'] as $key => $detail)
                    <div class="border rounded-lg p-4 hover:shadow-md transition-shadow bg-red-50">
                        <div class="flex justify-between items-center mb-2">
                            <h4 class="font-medium text-gray-700 capitalize">
                                @if($key == 'gratifikasi')
                                    Gratifikasi
                                @elseif($key == 'whistleblowing')
                                    Whistleblowing
                                @elseif($key == 'narkoba')
                                    Narkoba
                                @elseif($key == 'kritiksaran')
                                    Kritik & Saran
                                @endif
                            </h4>
                            <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                {{ $detail['total'] }}
                            </span>
                        </div>
                        <div class="text-sm text-gray-600 space-y-1">
                            <div class="flex justify-between">
                                <span>Hari ini:</span>
                                <span class="font-medium">{{ $detail['today'] }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Bulan ini:</span>
                                <span class="font-medium">{{ $detail['month'] }}</span>
                            </div>
                            <div class="text-xs {{ $detail['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }} text-right">
                                <i class="fas fa-arrow-{{ $detail['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                                {{ $detail['growth'] >= 0 ? '+' : '' }}{{ $detail['growth'] }}%
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Detail Kegiatan -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-tasks text-purple-500 mr-2"></i>
                    Detail Layanan Kegiatan
                    <span class="category-badge category-badge-kegiatan ml-2">4 Jenis</span>
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4">
                    @foreach($stats['kegiatan']['details'] as $key => $detail)
                    <div class="border rounded-lg p-4 hover:shadow-md transition-shadow bg-purple-50">
                        <div class="flex justify-between items-center mb-2">
                            <h4 class="font-medium text-gray-700 capitalize">
                                @if($key == 'magang')
                                    Magang
                                @elseif($key == 'tat')
                                    TAT
                                @elseif($key == 'sosialisasi')
                                    Sosialisasi
                                @elseif($key == 'tes_urine')
                                    Tes Urine
                                @endif
                            </h4>
                            <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded">
                                {{ $detail['total'] }}
                            </span>
                        </div>
                        <div class="text-sm text-gray-600 space-y-1">
                            <div class="flex justify-between">
                                <span>Hari ini:</span>
                                <span class="font-medium">{{ $detail['today'] }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Bulan ini:</span>
                                <span class="font-medium">{{ $detail['month'] }}</span>
                            </div>
                            <div class="text-xs {{ $detail['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }} text-right">
                                <i class="fas fa-arrow-{{ $detail['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                                {{ $detail['growth'] >= 0 ? '+' : '' }}{{ $detail['growth'] }}%
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Cards untuk PPID dan Rehabilitasi -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Detail PPID -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-file-alt text-blue-500 mr-2"></i>
                    Detail Layanan PPID
                    <span class="category-badge category-badge-ppid ml-2">Informasi Publik</span>
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <!-- Stats Overview -->
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div class="text-center p-3 bg-blue-50 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600">{{ number_format($stats['ppid']['total']) }}</div>
                            <div class="text-xs text-gray-500">Total</div>
                        </div>
                        <div class="text-center p-3 bg-blue-50 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600">{{ number_format($stats['ppid']['month']) }}</div>
                            <div class="text-xs text-gray-500">Bulan Ini</div>
                        </div>
                        <div class="text-center p-3 bg-blue-50 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600">{{ number_format($stats['ppid']['today']) }}</div>
                            <div class="text-xs text-gray-500">Hari Ini</div>
                        </div>
                    </div>
                    
                    <!-- Growth Info -->
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Pertumbuhan (hari ini):</span>
                            <span class="text-sm {{ $stats['ppid']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }}">
                                <i class="fas fa-arrow-{{ $stats['ppid']['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                                {{ $stats['ppid']['growth'] >= 0 ? '+' : '' }}{{ $stats['ppid']['growth'] }}%
                            </span>
                        </div>
                        <div class="flex justify-between items-center mt-1">
                            <span class="text-sm text-gray-600">Minggu ini:</span>
                            <span class="text-sm font-medium">{{ number_format($stats['ppid']['week']) }} data</span>
                        </div>
                    </div>
                    
                    <!-- Quick Info -->
                    <div class="p-3 bg-blue-50 rounded-lg">
                        <p class="text-sm text-blue-700">
                            <i class="fas fa-info-circle mr-2"></i>
                            Layanan Permohonan Informasi Publik sesuai UU KIP
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Rehabilitasi -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-heartbeat text-green-500 mr-2"></i>
                    Detail Layanan Rehabilitasi
                    <span class="category-badge category-badge-rehabilitasi ml-2">Kesehatan</span>
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <!-- Stats Overview -->
                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div class="text-center p-3 bg-green-50 rounded-lg">
                            <div class="text-2xl font-bold text-green-600">{{ number_format($stats['rehabilitasi']['total']) }}</div>
                            <div class="text-xs text-gray-500">Total</div>
                        </div>
                        <div class="text-center p-3 bg-green-50 rounded-lg">
                            <div class="text-2xl font-bold text-green-600">{{ number_format($stats['rehabilitasi']['month']) }}</div>
                            <div class="text-xs text-gray-500">Bulan Ini</div>
                        </div>
                        <div class="text-center p-3 bg-green-50 rounded-lg">
                            <div class="text-2xl font-bold text-green-600">{{ number_format($stats['rehabilitasi']['today']) }}</div>
                            <div class="text-xs text-gray-500">Hari Ini</div>
                        </div>
                    </div>
                    
                    <!-- Growth Info -->
                    <div class="p-3 bg-gray-50 rounded-lg">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Pertumbuhan (hari ini):</span>
                            <span class="text-sm {{ $stats['rehabilitasi']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }}">
                                <i class="fas fa-arrow-{{ $stats['rehabilitasi']['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                                {{ $stats['rehabilitasi']['growth'] >= 0 ? '+' : '' }}{{ $stats['rehabilitasi']['growth'] }}%
                            </span>
                        </div>
                        <div class="flex justify-between items-center mt-1">
                            <span class="text-sm text-gray-600">Minggu ini:</span>
                            <span class="text-sm font-medium">{{ number_format($stats['rehabilitasi']['week']) }} data</span>
                        </div>
                    </div>
                    
                    <!-- Quick Info -->
                    <div class="p-3 bg-green-50 rounded-lg">
                        <p class="text-sm text-green-700">
                            <i class="fas fa-info-circle mr-2"></i>
                            Layanan rehabilitasi untuk penyembuhan ketergantungan narkoba
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Overview -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Ringkasan Harian</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="text-center p-4 bg-red-50 rounded-lg">
                    <div class="text-2xl font-bold text-red-600">{{ number_format($stats['pengaduan']['today']) }}</div>
                    <div class="text-sm text-gray-500">Pengaduan Hari Ini</div>
                    <div class="text-xs {{ $stats['pengaduan']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }}">
                        {{ $stats['pengaduan']['growth'] >= 0 ? '+' : '' }}{{ $stats['pengaduan']['growth'] }}%
                    </div>
                </div>
                <div class="text-center p-4 bg-blue-50 rounded-lg">
                    <div class="text-2xl font-bold text-blue-600">{{ number_format($stats['ppid']['today']) }}</div>
                    <div class="text-sm text-gray-500">PPID Hari Ini</div>
                    <div class="text-xs {{ $stats['ppid']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }}">
                        {{ $stats['ppid']['growth'] >= 0 ? '+' : '' }}{{ $stats['ppid']['growth'] }}%
                    </div>
                </div>
                <div class="text-center p-4 bg-green-50 rounded-lg">
                    <div class="text-2xl font-bold text-green-600">{{ number_format($stats['rehabilitasi']['today']) }}</div>
                    <div class="text-sm text-gray-500">Rehabilitasi Hari Ini</div>
                    <div class="text-xs {{ $stats['rehabilitasi']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }}">
                        {{ $stats['rehabilitasi']['growth'] >= 0 ? '+' : '' }}{{ $stats['rehabilitasi']['growth'] }}%
                    </div>
                </div>
                <div class="text-center p-4 bg-purple-50 rounded-lg">
                    <div class="text-2xl font-bold text-purple-600">{{ number_format($stats['kegiatan']['today']) }}</div>
                    <div class="text-sm text-gray-500">Kegiatan Hari Ini</div>
                    <div class="text-xs {{ $stats['kegiatan']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }}">
                        {{ $stats['kegiatan']['growth'] >= 0 ? '+' : '' }}{{ $stats['kegiatan']['growth'] }}%
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Card -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Selamat Datang di Admin SITERKENAL</h3>
        </div>
        <div class="p-6">
            <p class="text-gray-600 mb-4">
                Halo <strong>{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</strong>, 
                selamat datang di panel administrator SITERKENAL. Sistem ini mengelola 4 layanan utama:
            </p>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                <div class="text-center p-4 border rounded-lg">
                    <div class="inline-flex items-center justify-center w-12 h-12 mb-2 bg-red-100 rounded-full">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <h4 class="font-medium text-gray-900">Pengaduan</h4>
                    <p class="text-sm text-gray-500">4 jenis pengaduan masyarakat</p>
                </div>
                <div class="text-center p-4 border rounded-lg">
                    <div class="inline-flex items-center justify-center w-12 h-12 mb-2 bg-blue-100 rounded-full">
                        <i class="fas fa-file-alt text-blue-600"></i>
                    </div>
                    <h4 class="font-medium text-gray-900">PPID</h4>
                    <p class="text-sm text-gray-500">Layanan informasi publik</p>
                </div>
                <div class="text-center p-4 border rounded-lg">
                    <div class="inline-flex items-center justify-center w-12 h-12 mb-2 bg-green-100 rounded-full">
                        <i class="fas fa-heartbeat text-green-600"></i>
                    </div>
                    <h4 class="font-medium text-gray-900">Rehabilitasi</h4>
                    <p class="text-sm text-gray-500">Pemulihan kesehatan</p>
                </div>
                <div class="text-center p-4 border rounded-lg">
                    <div class="inline-flex items-center justify-center w-12 h-12 mb-2 bg-purple-100 rounded-full">
                        <i class="fas fa-tasks text-purple-600"></i>
                    </div>
                    <h4 class="font-medium text-gray-900">Kegiatan</h4>
                    <p class="text-sm text-gray-500">4 jenis kegiatan</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Pastikan Chart.js sudah terload
    console.log('Chart.js loaded:', typeof Chart !== 'undefined');
    
    // Data dari controller untuk JavaScript
    const chartData = @json($chartData);
    
    console.log('Chart data loaded:', chartData);
    
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM loaded, initializing charts...');
        
        // Inisialisasi charts
        initTotalChart();
        initMonthlyChart();
    });
    
    function initTotalChart() {
        const ctx = document.getElementById('totalChart');
        if (!ctx) {
            console.error('Total chart canvas not found');
            return;
        }
        
        try {
            // Destroy existing chart if any
            if (window.totalChartInstance) {
                window.totalChartInstance.destroy();
            }
            
            window.totalChartInstance = new Chart(ctx, {
                type: 'bar',
                data: chartData.total,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.dataset.label}: ${context.parsed.y.toLocaleString('id-ID')}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return value.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });
            
            console.log('✅ Total chart initialized');
        } catch (error) {
            console.error('❌ Error initializing total chart:', error);
        }
    }
    
    function initMonthlyChart() {
        const ctx = document.getElementById('monthlyChart');
        if (!ctx) {
            console.error('Monthly chart canvas not found');
            return;
        }
        
        try {
            // Destroy existing chart if any
            if (window.monthlyChartInstance) {
                window.monthlyChartInstance.destroy();
            }
            
            window.monthlyChartInstance = new Chart(ctx, {
                type: 'doughnut',
                data: chartData.monthly,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'right',
                            labels: {
                                padding: 20,
                                usePointStyle: true
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.parsed || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                                    return `${label}: ${value.toLocaleString('id-ID')} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
            
            console.log('✅ Monthly chart initialized');
        } catch (error) {
            console.error('❌ Error initializing monthly chart:', error);
        }
    }
</script>
@endpush