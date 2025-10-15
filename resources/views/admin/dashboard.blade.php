<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<style>
    .stat-card:hover {
        transform: translateY(-2px);
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    .growth-positive { color: #10B981; }
    .growth-negative { color: #EF4444; }
    .notification-badge {
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
</style>

<!-- Notification Toast -->
<div id="notificationToast" class="hidden fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
    <div class="flex items-center">
        <i class="fas fa-bell mr-3"></i>
        <span id="notificationMessage"></span>
        <button onclick="hideNotification()" class="ml-4 text-white hover:text-gray-200">
            <i class="fas fa-times"></i>
        </button>
    </div>
</div>

<!-- Total Overview -->
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
                <p class="text-xs opacity-80">Semua jenis layanan</p>
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
                <p class="text-2xl font-semibold text-gray-900">
                    {{ number_format(array_sum(array_column($stats['pengaduan'], 'total'))) }}
                </p>
                <p class="text-xs text-gray-500">4 jenis pengaduan</p>
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
                    {{ $stats['ppid']['growth'] >= 0 ? '+' : '' }}{{ $stats['ppid']['growth'] }}% dari kemarin
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
                    {{ $stats['rehabilitasi']['growth'] >= 0 ? '+' : '' }}{{ $stats['rehabilitasi']['growth'] }}% dari kemarin
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
                <p class="text-2xl font-semibold text-gray-900">
                    {{ number_format(array_sum(array_column($stats['kegiatan'], 'total'))) }}
                </p>
                <p class="text-xs text-gray-500">4 jenis kegiatan</p>
            </div>
        </div>
    </div>
</div>

<!-- Statistik Pengunjung Website -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <!-- Pengunjung Hari Ini -->
    <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg shadow text-white p-6 stat-card">
        <div class="flex items-center">
            <div class="p-3 bg-orange-400 rounded-lg bg-opacity-20">
                <i class="fas fa-users text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium opacity-90">Pengunjung Hari Ini</h3>
                <p class="text-2xl font-semibold">{{ number_format($visitorStats['today']['count']) }}</p>
                <p class="text-xs opacity-80 {{ $visitorStats['today']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }}">
                    {{ $visitorStats['today']['growth'] >= 0 ? '+' : '' }}{{ $visitorStats['today']['growth'] }}% dari kemarin
                </p>
            </div>
        </div>
    </div>

    <!-- Pengunjung Minggu Ini -->
    <div class="bg-gradient-to-r from-pink-500 to-pink-600 rounded-lg shadow text-white p-6 stat-card">
        <div class="flex items-center">
            <div class="p-3 bg-pink-400 rounded-lg bg-opacity-20">
                <i class="fas fa-chart-line text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium opacity-90">Pengunjung Minggu Ini</h3>
                <p class="text-2xl font-semibold">{{ number_format($visitorStats['week']['count']) }}</p>
                <p class="text-xs opacity-80 {{ $visitorStats['week']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }}">
                    {{ $visitorStats['week']['growth'] >= 0 ? '+' : '' }}{{ $visitorStats['week']['growth'] }}% dari minggu lalu
                </p>
            </div>
        </div>
    </div>

    <!-- Pengunjung Bulan Ini -->
    <div class="bg-gradient-to-r from-teal-500 to-teal-600 rounded-lg shadow text-white p-6 stat-card">
        <div class="flex items-center">
            <div class="p-3 bg-teal-400 rounded-lg bg-opacity-20">
                <i class="fas fa-calendar-alt text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium opacity-90">Pengunjung Bulan Ini</h3>
                <p class="text-2xl font-semibold">{{ number_format($visitorStats['month']['count']) }}</p>
                <p class="text-xs opacity-80 {{ $visitorStats['month']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }}">
                    {{ $visitorStats['month']['growth'] >= 0 ? '+' : '' }}{{ $visitorStats['month']['growth'] }}% dari bulan lalu
                </p>
            </div>
        </div>
    </div>

    <!-- Total Pengunjung -->
    <div class="bg-gradient-to-r from-gray-700 to-gray-800 rounded-lg shadow text-white p-6 stat-card">
        <div class="flex items-center">
            <div class="p-3 bg-gray-600 rounded-lg bg-opacity-20">
                <i class="fas fa-globe text-xl"></i>
            </div>
            <div class="ml-4">
                <h3 class="text-sm font-medium opacity-90">Total Pengunjung</h3>
                <p class="text-2xl font-semibold">{{ number_format($visitorStats['total']['count']) }}</p>
                <p class="text-xs opacity-80">Sejak website diluncurkan</p>
            </div>
        </div>
    </div>
</div>

<!-- Detailed Statistics Grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <!-- Chart Mingguan -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik Input Data & Pengunjung (7 Hari Terakhir)</h3>
        <div class="h-64">
            <canvas id="weeklyChart"></canvas>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Aktivitas Terbaru</h3>
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

<!-- Layanan Details -->
<div class="bg-white rounded-lg shadow mb-6">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Detail Semua Layanan</h3>
    </div>
    <div class="p-6">
        <!-- Pengaduan Masyarakat -->
        <div class="mb-8">
            <h4 class="font-semibold text-gray-700 mb-4 flex items-center">
                <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                Pengaduan Masyarakat
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($stats['pengaduan'] as $key => $pengaduan)
                <div class="border rounded-lg p-4 hover:shadow-md transition-shadow bg-red-50">
                    <div class="flex items-center justify-between">
                        <h4 class="font-medium text-gray-700 capitalize">
                            @if($key == 'gratifikasi') Gratifikasi
                            @elseif($key == 'whistleblowing') Whistleblowing
                            @elseif($key == 'narkoba') Narkoba
                            @elseif($key == 'kritiksaran') Kritik & Saran
                            @endif
                        </h4>
                        <span class="text-xs px-2 py-1 bg-red-100 text-red-800 rounded-full">{{ $pengaduan['total'] }}</span>
                    </div>
                    <div class="mt-2 text-sm text-gray-600 space-y-1">
                        <div>Hari ini: <strong>{{ $pengaduan['today'] }}</strong></div>
                        <div>Minggu ini: <strong>{{ $pengaduan['week'] }}</strong></div>
                        <div>Bulan ini: <strong>{{ $pengaduan['month'] }}</strong></div>
                        <div class="text-xs {{ $pengaduan['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }} mt-1">
                            <i class="fas fa-arrow-{{ $pengaduan['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                            {{ $pengaduan['growth'] >= 0 ? '+' : '' }}{{ $pengaduan['growth'] }}% (hari ini)
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Layanan Kegiatan -->
        <div class="mb-8">
            <h4 class="font-semibold text-gray-700 mb-4 flex items-center">
                <i class="fas fa-tasks text-purple-500 mr-2"></i>
                Layanan Kegiatan
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($stats['kegiatan'] as $key => $kegiatan)
                <div class="border rounded-lg p-4 hover:shadow-md transition-shadow bg-purple-50">
                    <div class="flex items-center justify-between">
                        <h4 class="font-medium text-gray-700 capitalize">
                            @if($key == 'magang') Magang
                            @elseif($key == 'tat') TAT
                            @elseif($key == 'sosialisasi') Sosialisasi
                            @elseif($key == 'tes_urine') Tes Urine
                            @endif
                        </h4>
                        <span class="text-xs px-2 py-1 bg-purple-100 text-purple-800 rounded-full">{{ $kegiatan['total'] }}</span>
                    </div>
                    <div class="mt-2 text-sm text-gray-600 space-y-1">
                        <div>Hari ini: <strong>{{ $kegiatan['today'] }}</strong></div>
                        <div>Minggu ini: <strong>{{ $kegiatan['week'] }}</strong></div>
                        <div>Bulan ini: <strong>{{ $kegiatan['month'] }}</strong></div>
                        <div class="text-xs {{ $kegiatan['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }} mt-1">
                            <i class="fas fa-arrow-{{ $kegiatan['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                            {{ $kegiatan['growth'] >= 0 ? '+' : '' }}{{ $kegiatan['growth'] }}% (hari ini)
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Layanan Lainnya -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- PPID -->
            <div class="border rounded-lg p-4 hover:shadow-md transition-shadow bg-blue-50">
                <h4 class="font-semibold text-gray-700 mb-3 flex items-center">
                    <i class="fas fa-file-alt text-blue-500 mr-2"></i>
                    Layanan PPID
                </h4>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span>Total:</span>
                        <strong>{{ $stats['ppid']['total'] }}</strong>
                    </div>
                    <div class="flex justify-between">
                        <span>Hari ini:</span>
                        <strong>{{ $stats['ppid']['today'] }}</strong>
                    </div>
                    <div class="flex justify-between">
                        <span>Minggu ini:</span>
                        <strong>{{ $stats['ppid']['week'] }}</strong>
                    </div>
                    <div class="flex justify-between">
                        <span>Bulan ini:</span>
                        <strong>{{ $stats['ppid']['month'] }}</strong>
                    </div>
                    <div class="text-xs {{ $stats['ppid']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }} text-right">
                        <i class="fas fa-arrow-{{ $stats['ppid']['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                        {{ $stats['ppid']['growth'] >= 0 ? '+' : '' }}{{ $stats['ppid']['growth'] }}% (hari ini)
                    </div>
                </div>
            </div>

            <!-- Rehabilitasi -->
            <div class="border rounded-lg p-4 hover:shadow-md transition-shadow bg-green-50">
                <h4 class="font-semibold text-gray-700 mb-3 flex items-center">
                    <i class="fas fa-heartbeat text-green-500 mr-2"></i>
                    Rehabilitasi
                </h4>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span>Total:</span>
                        <strong>{{ $stats['rehabilitasi']['total'] }}</strong>
                    </div>
                    <div class="flex justify-between">
                        <span>Hari ini:</span>
                        <strong>{{ $stats['rehabilitasi']['today'] }}</strong>
                    </div>
                    <div class="flex justify-between">
                        <span>Minggu ini:</span>
                        <strong>{{ $stats['rehabilitasi']['week'] }}</strong>
                    </div>
                    <div class="flex justify-between">
                        <span>Bulan ini:</span>
                        <strong>{{ $stats['rehabilitasi']['month'] }}</strong>
                    </div>
                    <div class="text-xs {{ $stats['rehabilitasi']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }} text-right">
                        <i class="fas fa-arrow-{{ $stats['rehabilitasi']['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                        {{ $stats['rehabilitasi']['growth'] >= 0 ? '+' : '' }}{{ $stats['rehabilitasi']['growth'] }}% (hari ini)
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Welcome Section -->
<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900">Selamat Datang di Admin SITERKENAL</h3>
    </div>
    <div class="p-6">
        <p class="text-gray-600">Halo <strong>{{ Auth::guard('admin')->user()->name }}</strong>, selamat datang di panel administrator SITERKENAL.</p>
        <p class="text-gray-600 mt-2">Anda login sebagai: <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded">{{ Auth::guard('admin')->user()->role }}</span></p>
        
        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6 p-4 bg-gray-50 rounded-lg">
            <div class="text-center">
                <div class="text-2xl font-bold text-blue-600">{{ number_format($totalAllLayanan) }}</div>
                <div class="text-sm text-gray-500">Total Semua Layanan</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-green-600">{{ number_format($stats['ppid']['month'] + $stats['rehabilitasi']['month'] + array_sum(array_column($stats['kegiatan'], 'month')) + array_sum(array_column($stats['pengaduan'], 'month'))) }}</div>
                <div class="text-sm text-gray-500">Bulan Ini</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-purple-600">{{ number_format($stats['ppid']['week'] + $stats['rehabilitasi']['week'] + array_sum(array_column($stats['kegiatan'], 'week')) + array_sum(array_column($stats['pengaduan'], 'week'))) }}</div>
                <div class="text-sm text-gray-500">Minggu Ini</div>
            </div>
            <div class="text-center">
                <div class="text-2xl font-bold text-orange-600">{{ number_format($stats['ppid']['today'] + $stats['rehabilitasi']['today'] + array_sum(array_column($stats['kegiatan'], 'today')) + array_sum(array_column($stats['pengaduan'], 'today'))) }}</div>
                <div class="text-sm text-gray-500">Hari Ini</div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Weekly Chart
    const ctx = document.getElementById('weeklyChart').getContext('2d');
    const weeklyChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($weeklyData['labels']) !!},
            datasets: [
                {
                    label: 'Pengaduan Masyarakat',
                    data: {!! json_encode($weeklyData['datasets']['pengaduan']) !!},
                    borderColor: '#EF4444',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'PPID',
                    data: {!! json_encode($weeklyData['datasets']['ppid']) !!},
                    borderColor: '#3B82F6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Rehabilitasi',
                    data: {!! json_encode($weeklyData['datasets']['rehabilitasi']) !!},
                    borderColor: '#10B981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Kegiatan',
                    data: {!! json_encode($weeklyData['datasets']['kegiatan']) !!},
                    borderColor: '#8B5CF6',
                    backgroundColor: 'rgba(139, 92, 246, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Pengunjung Website',
                    data: {!! json_encode($weeklyData['datasets']['pengunjung']) !!},
                    borderColor: '#F59E0B',
                    backgroundColor: 'rgba(245, 158, 11, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });

    // Real-time notification system
    function checkNewData() {
        fetch('{{ route("admin.checkNewData") }}')
            .then(response => response.json())
            .then(data => {
                if(data.hasNewData) {
                    data.messages.forEach(message => {
                        showNotification('📢 ' + message);
                    });
                }
            })
            .catch(error => console.error('Error checking new data:', error));
    }

    function showNotification(message) {
        const toast = document.getElementById('notificationToast');
        const messageEl = document.getElementById('notificationMessage');
        
        messageEl.textContent = message;
        toast.classList.remove('hidden');
        
        setTimeout(hideNotification, 5000);
    }

    function hideNotification() {
        document.getElementById('notificationToast').classList.add('hidden');
    }

    // Check for new data every 30 seconds
    setInterval(checkNewData, 30000);

    // Check immediately on page load
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(checkNewData, 2000);
    });
</script>
@endsection
@endsection