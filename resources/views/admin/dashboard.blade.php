@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <style>
        .stat-card:hover {
            transform: translateY(-2px);
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .growth-positive {
            color: #10B981;
        }

        .growth-negative {
            color: #EF4444;
        }

        .notification-badge {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }
    </style>

    <!-- Notification Toast -->
    <div id="notificationToast"
        class="hidden fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
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
                        {{ number_format(
                            $stats['pengaduan']['gratifikasi']['total'] +
                                $stats['pengaduan']['whistleblowing']['total'] +
                                $stats['pengaduan']['narkoba']['total'] +
                                $stats['pengaduan']['kritiksaran']['total'],
                        ) }}
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
                        {{ $stats['rehabilitasi']['growth'] >= 0 ? '+' : '' }}{{ $stats['rehabilitasi']['growth'] }}% dari
                        kemarin
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
                        {{ number_format(
                            $stats['kegiatan']['magang']['total'] +
                                $stats['kegiatan']['tat']['total'] +
                                $stats['kegiatan']['sosialisasi']['total'] +
                                $stats['kegiatan']['tes_urine']['total'],
                        ) }}
                    </p>
                    <p class="text-xs text-gray-500">4 jenis kegiatan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Trend Bulanan (12 Bulan Terakhir) -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Trend Input Data (12 Bulan Terakhir)</h3>
            <div class="h-64">
                <canvas id="monthlyTrendChart"></canvas>
            </div>
        </div>

        <!-- Distribusi Kategori -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Distribusi Semua Layanan</h3>
            <div class="h-64">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Perbandingan Tahun -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Perbandingan Tahun Ini vs Tahun Lalu -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Perbandingan Tahun {{ now()->year }} vs
                {{ now()->subYear()->year }}</h3>
            <div class="h-64">
                <canvas id="yearlyComparisonChart"></canvas>
            </div>
        </div>

        <!-- Statistik Ringkas -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik Ringkas</h3>
            <div class="space-y-4">
                <!-- Total per Kategori -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <div class="p-2 bg-blue-100 rounded-lg mr-3">
                                <i class="fas fa-exclamation-triangle text-blue-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Pengaduan</p>
                                <p class="text-xl font-bold text-gray-900">
                                    {{ number_format(
                                        $stats['pengaduan']['gratifikasi']['total'] +
                                            $stats['pengaduan']['whistleblowing']['total'] +
                                            $stats['pengaduan']['narkoba']['total'] +
                                            $stats['pengaduan']['kritiksaran']['total'],
                                    ) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <div class="p-2 bg-green-100 rounded-lg mr-3">
                                <i class="fas fa-file-alt text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total PPID</p>
                                <p class="text-xl font-bold text-gray-900">
                                    {{ number_format($stats['ppid']['total']) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <div class="p-2 bg-purple-100 rounded-lg mr-3">
                                <i class="fas fa-heartbeat text-purple-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Rehabilitasi</p>
                                <p class="text-xl font-bold text-gray-900">
                                    {{ number_format($stats['rehabilitasi']['total']) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-orange-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <div class="p-2 bg-orange-100 rounded-lg mr-3">
                                <i class="fas fa-tasks text-orange-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Kegiatan</p>
                                <p class="text-xl font-bold text-gray-900">
                                    {{ number_format(
                                        $stats['kegiatan']['magang']['total'] +
                                            $stats['kegiatan']['tat']['total'] +
                                            $stats['kegiatan']['sosialisasi']['total'] +
                                            $stats['kegiatan']['tes_urine']['total'],
                                    ) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rata-rata Bulanan -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h4 class="font-semibold text-gray-700 mb-2">Rata-rata per Bulan</h4>
                    <div class="grid grid-cols-4 gap-2 text-center">
                        <div>
                            <p class="text-2xl font-bold text-blue-600">
                                {{ number_format(($stats['pengaduan']['gratifikasi']['total'] + $stats['pengaduan']['whistleblowing']['total'] + $stats['pengaduan']['narkoba']['total'] + $stats['pengaduan']['kritiksaran']['total']) / max(1, 12)) }}
                            </p>
                            <p class="text-xs text-gray-500">Pengaduan</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-green-600">
                                {{ number_format($stats['ppid']['total'] / max(1, 12)) }}
                            </p>
                            <p class="text-xs text-gray-500">PPID</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-purple-600">
                                {{ number_format($stats['rehabilitasi']['total'] / max(1, 12)) }}
                            </p>
                            <p class="text-xs text-gray-500">Rehabilitasi</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-orange-600">
                                {{ number_format(($stats['kegiatan']['magang']['total'] + $stats['kegiatan']['tat']['total'] + $stats['kegiatan']['sosialisasi']['total'] + $stats['kegiatan']['tes_urine']['total']) / max(1, 12)) }}
                            </p>
                            <p class="text-xs text-gray-500">Kegiatan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
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
                    <!-- Gratifikasi -->
                    <div class="border rounded-lg p-4 hover:shadow-md transition-shadow bg-red-50">
                        <div class="flex items-center justify-between">
                            <h4 class="font-medium text-gray-700">Gratifikasi</h4>
                            <span
                                class="text-xs px-2 py-1 bg-red-100 text-red-800 rounded-full">{{ $stats['pengaduan']['gratifikasi']['total'] }}</span>
                        </div>
                        <div class="mt-2 text-sm text-gray-600 space-y-1">
                            <div>Hari ini: <strong>{{ $stats['pengaduan']['gratifikasi']['today'] }}</strong></div>
                            <div>Minggu ini: <strong>{{ $stats['pengaduan']['gratifikasi']['week'] }}</strong></div>
                            <div>Bulan ini: <strong>{{ $stats['pengaduan']['gratifikasi']['month'] }}</strong></div>
                            <div
                                class="text-xs {{ $stats['pengaduan']['gratifikasi']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }} mt-1">
                                <i
                                    class="fas fa-arrow-{{ $stats['pengaduan']['gratifikasi']['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                                {{ $stats['pengaduan']['gratifikasi']['growth'] >= 0 ? '+' : '' }}{{ $stats['pengaduan']['gratifikasi']['growth'] }}%
                                (hari ini)
                            </div>
                        </div>
                    </div>

                    <!-- Whistleblowing -->
                    <div class="border rounded-lg p-4 hover:shadow-md transition-shadow bg-red-50">
                        <div class="flex items-center justify-between">
                            <h4 class="font-medium text-gray-700">Whistleblowing</h4>
                            <span
                                class="text-xs px-2 py-1 bg-red-100 text-red-800 rounded-full">{{ $stats['pengaduan']['whistleblowing']['total'] }}</span>
                        </div>
                        <div class="mt-2 text-sm text-gray-600 space-y-1">
                            <div>Hari ini: <strong>{{ $stats['pengaduan']['whistleblowing']['today'] }}</strong></div>
                            <div>Minggu ini: <strong>{{ $stats['pengaduan']['whistleblowing']['week'] }}</strong></div>
                            <div>Bulan ini: <strong>{{ $stats['pengaduan']['whistleblowing']['month'] }}</strong></div>
                            <div
                                class="text-xs {{ $stats['pengaduan']['whistleblowing']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }} mt-1">
                                <i
                                    class="fas fa-arrow-{{ $stats['pengaduan']['whistleblowing']['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                                {{ $stats['pengaduan']['whistleblowing']['growth'] >= 0 ? '+' : '' }}{{ $stats['pengaduan']['whistleblowing']['growth'] }}%
                                (hari ini)
                            </div>
                        </div>
                    </div>

                    <!-- Narkoba -->
                    <div class="border rounded-lg p-4 hover:shadow-md transition-shadow bg-red-50">
                        <div class="flex items-center justify-between">
                            <h4 class="font-medium text-gray-700">Narkoba</h4>
                            <span
                                class="text-xs px-2 py-1 bg-red-100 text-red-800 rounded-full">{{ $stats['pengaduan']['narkoba']['total'] }}</span>
                        </div>
                        <div class="mt-2 text-sm text-gray-600 space-y-1">
                            <div>Hari ini: <strong>{{ $stats['pengaduan']['narkoba']['today'] }}</strong></div>
                            <div>Minggu ini: <strong>{{ $stats['pengaduan']['narkoba']['week'] }}</strong></div>
                            <div>Bulan ini: <strong>{{ $stats['pengaduan']['narkoba']['month'] }}</strong></div>
                            <div
                                class="text-xs {{ $stats['pengaduan']['narkoba']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }} mt-1">
                                <i
                                    class="fas fa-arrow-{{ $stats['pengaduan']['narkoba']['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                                {{ $stats['pengaduan']['narkoba']['growth'] >= 0 ? '+' : '' }}{{ $stats['pengaduan']['narkoba']['growth'] }}%
                                (hari ini)
                            </div>
                        </div>
                    </div>

                    <!-- Kritik & Saran -->
                    <div class="border rounded-lg p-4 hover:shadow-md transition-shadow bg-red-50">
                        <div class="flex items-center justify-between">
                            <h4 class="font-medium text-gray-700">Kritik & Saran</h4>
                            <span
                                class="text-xs px-2 py-1 bg-red-100 text-red-800 rounded-full">{{ $stats['pengaduan']['kritiksaran']['total'] }}</span>
                        </div>
                        <div class="mt-2 text-sm text-gray-600 space-y-1">
                            <div>Hari ini: <strong>{{ $stats['pengaduan']['kritiksaran']['today'] }}</strong></div>
                            <div>Minggu ini: <strong>{{ $stats['pengaduan']['kritiksaran']['week'] }}</strong></div>
                            <div>Bulan ini: <strong>{{ $stats['pengaduan']['kritiksaran']['month'] }}</strong></div>
                            <div
                                class="text-xs {{ $stats['pengaduan']['kritiksaran']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }} mt-1">
                                <i
                                    class="fas fa-arrow-{{ $stats['pengaduan']['kritiksaran']['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                                {{ $stats['pengaduan']['kritiksaran']['growth'] >= 0 ? '+' : '' }}{{ $stats['pengaduan']['kritiksaran']['growth'] }}%
                                (hari ini)
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Layanan Kegiatan -->
            <div class="mb-8">
                <h4 class="font-semibold text-gray-700 mb-4 flex items-center">
                    <i class="fas fa-tasks text-purple-500 mr-2"></i>
                    Layanan Kegiatan
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <!-- Magang -->
                    <div class="border rounded-lg p-4 hover:shadow-md transition-shadow bg-purple-50">
                        <div class="flex items-center justify-between">
                            <h4 class="font-medium text-gray-700">Magang</h4>
                            <span
                                class="text-xs px-2 py-1 bg-purple-100 text-purple-800 rounded-full">{{ $stats['kegiatan']['magang']['total'] }}</span>
                        </div>
                        <div class="mt-2 text-sm text-gray-600 space-y-1">
                            <div>Hari ini: <strong>{{ $stats['kegiatan']['magang']['today'] }}</strong></div>
                            <div>Minggu ini: <strong>{{ $stats['kegiatan']['magang']['week'] }}</strong></div>
                            <div>Bulan ini: <strong>{{ $stats['kegiatan']['magang']['month'] }}</strong></div>
                            <div
                                class="text-xs {{ $stats['kegiatan']['magang']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }} mt-1">
                                <i
                                    class="fas fa-arrow-{{ $stats['kegiatan']['magang']['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                                {{ $stats['kegiatan']['magang']['growth'] >= 0 ? '+' : '' }}{{ $stats['kegiatan']['magang']['growth'] }}%
                                (hari ini)
                            </div>
                        </div>
                    </div>

                    <!-- TAT -->
                    <div class="border rounded-lg p-4 hover:shadow-md transition-shadow bg-purple-50">
                        <div class="flex items-center justify-between">
                            <h4 class="font-medium text-gray-700">TAT</h4>
                            <span
                                class="text-xs px-2 py-1 bg-purple-100 text-purple-800 rounded-full">{{ $stats['kegiatan']['tat']['total'] }}</span>
                        </div>
                        <div class="mt-2 text-sm text-gray-600 space-y-1">
                            <div>Hari ini: <strong>{{ $stats['kegiatan']['tat']['today'] }}</strong></div>
                            <div>Minggu ini: <strong>{{ $stats['kegiatan']['tat']['week'] }}</strong></div>
                            <div>Bulan ini: <strong>{{ $stats['kegiatan']['tat']['month'] }}</strong></div>
                            <div
                                class="text-xs {{ $stats['kegiatan']['tat']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }} mt-1">
                                <i
                                    class="fas fa-arrow-{{ $stats['kegiatan']['tat']['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                                {{ $stats['kegiatan']['tat']['growth'] >= 0 ? '+' : '' }}{{ $stats['kegiatan']['tat']['growth'] }}%
                                (hari ini)
                            </div>
                        </div>
                    </div>

                    <!-- Sosialisasi -->
                    <div class="border rounded-lg p-4 hover:shadow-md transition-shadow bg-purple-50">
                        <div class="flex items-center justify-between">
                            <h4 class="font-medium text-gray-700">Sosialisasi</h4>
                            <span
                                class="text-xs px-2 py-1 bg-purple-100 text-purple-800 rounded-full">{{ $stats['kegiatan']['sosialisasi']['total'] }}</span>
                        </div>
                        <div class="mt-2 text-sm text-gray-600 space-y-1">
                            <div>Hari ini: <strong>{{ $stats['kegiatan']['sosialisasi']['today'] }}</strong></div>
                            <div>Minggu ini: <strong>{{ $stats['kegiatan']['sosialisasi']['week'] }}</strong></div>
                            <div>Bulan ini: <strong>{{ $stats['kegiatan']['sosialisasi']['month'] }}</strong></div>
                            <div
                                class="text-xs {{ $stats['kegiatan']['sosialisasi']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }} mt-1">
                                <i
                                    class="fas fa-arrow-{{ $stats['kegiatan']['sosialisasi']['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                                {{ $stats['kegiatan']['sosialisasi']['growth'] >= 0 ? '+' : '' }}{{ $stats['kegiatan']['sosialisasi']['growth'] }}%
                                (hari ini)
                            </div>
                        </div>
                    </div>

                    <!-- Tes Urine -->
                    <div class="border rounded-lg p-4 hover:shadow-md transition-shadow bg-purple-50">
                        <div class="flex items-center justify-between">
                            <h4 class="font-medium text-gray-700">Tes Urine</h4>
                            <span
                                class="text-xs px-2 py-1 bg-purple-100 text-purple-800 rounded-full">{{ $stats['kegiatan']['tes_urine']['total'] }}</span>
                        </div>
                        <div class="mt-2 text-sm text-gray-600 space-y-1">
                            <div>Hari ini: <strong>{{ $stats['kegiatan']['tes_urine']['today'] }}</strong></div>
                            <div>Minggu ini: <strong>{{ $stats['kegiatan']['tes_urine']['week'] }}</strong></div>
                            <div>Bulan ini: <strong>{{ $stats['kegiatan']['tes_urine']['month'] }}</strong></div>
                            <div
                                class="text-xs {{ $stats['kegiatan']['tes_urine']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }} mt-1">
                                <i
                                    class="fas fa-arrow-{{ $stats['kegiatan']['tes_urine']['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                                {{ $stats['kegiatan']['tes_urine']['growth'] >= 0 ? '+' : '' }}{{ $stats['kegiatan']['tes_urine']['growth'] }}%
                                (hari ini)
                            </div>
                        </div>
                    </div>
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
                        <div
                            class="text-xs {{ $stats['ppid']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }} text-right">
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
                        <div
                            class="text-xs {{ $stats['rehabilitasi']['growth'] >= 0 ? 'growth-positive' : 'growth-negative' }} text-right">
                            <i class="fas fa-arrow-{{ $stats['rehabilitasi']['growth'] >= 0 ? 'up' : 'down' }} mr-1"></i>
                            {{ $stats['rehabilitasi']['growth'] >= 0 ? '+' : '' }}{{ $stats['rehabilitasi']['growth'] }}%
                            (hari ini)
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
            <p class="text-gray-600">Halo <strong>{{ Auth::guard('admin')->user()->name }}</strong>, selamat datang di
                panel administrator SITERKENAL.</p>
            <p class="text-gray-600 mt-2">Anda login sebagai: <span
                    class="bg-blue-100 text-blue-800 px-2 py-1 rounded">{{ Auth::guard('admin')->user()->role }}</span>
            </p>

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6 p-4 bg-gray-50 rounded-lg">
                <div class="text-center">
                    <div class="text-2xl font-bold text-blue-600">{{ number_format($totalAllLayanan) }}</div>
                    <div class="text-sm text-gray-500">Total Semua Layanan</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-green-600">
                        {{ number_format(
                            $stats['ppid']['month'] +
                                $stats['rehabilitasi']['month'] +
                                $stats['kegiatan']['magang']['month'] +
                                $stats['kegiatan']['tat']['month'] +
                                $stats['kegiatan']['sosialisasi']['month'] +
                                $stats['kegiatan']['tes_urine']['month'] +
                                $stats['pengaduan']['gratifikasi']['month'] +
                                $stats['pengaduan']['whistleblowing']['month'] +
                                $stats['pengaduan']['narkoba']['month'] +
                                $stats['pengaduan']['kritiksaran']['month'],
                        ) }}
                    </div>
                    <div class="text-sm text-gray-500">Bulan Ini</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-purple-600">
                        {{ number_format(
                            $stats['ppid']['week'] +
                                $stats['rehabilitasi']['week'] +
                                $stats['kegiatan']['magang']['week'] +
                                $stats['kegiatan']['tat']['week'] +
                                $stats['kegiatan']['sosialisasi']['week'] +
                                $stats['kegiatan']['tes_urine']['week'] +
                                $stats['pengaduan']['gratifikasi']['week'] +
                                $stats['pengaduan']['whistleblowing']['week'] +
                                $stats['pengaduan']['narkoba']['week'] +
                                $stats['pengaduan']['kritiksaran']['week'],
                        ) }}
                    </div>
                    <div class="text-sm text-gray-500">Minggu Ini</div>
                </div>
                <div class="text-center">
                    <div class="text-2xl font-bold text-orange-600">
                        {{ number_format(
                            $stats['ppid']['today'] +
                                $stats['rehabilitasi']['today'] +
                                $stats['kegiatan']['magang']['today'] +
                                $stats['kegiatan']['tat']['today'] +
                                $stats['kegiatan']['sosialisasi']['today'] +
                                $stats['kegiatan']['tes_urine']['today'] +
                                $stats['pengaduan']['gratifikasi']['today'] +
                                $stats['pengaduan']['whistleblowing']['today'] +
                                $stats['pengaduan']['narkoba']['today'] +
                                $stats['pengaduan']['kritiksaran']['today'],
                        ) }}
                    </div>
                    <div class="text-sm text-gray-500">Hari Ini</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<!-- Load Chart.js langsung di sini -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Tunggu Chart.js selesai load
    window.addEventListener('load', function() {
        console.log('✅ Page fully loaded');
        console.log('✅ Chart.js version:', Chart?.version);
        
        initializeAllCharts();
    });

    function initializeAllCharts() {
        console.log('🔄 Initializing charts...');
        
        // Chart 1: Monthly Trend
        const ctx1 = document.getElementById('monthlyTrendChart');
        if (ctx1) {
            console.log('📊 Monthly chart canvas found');
            createMonthlyChart(ctx1);
        } else {
            console.error('❌ Monthly chart canvas NOT found');
        }

        // Chart 2: Category Distribution
        const ctx2 = document.getElementById('categoryChart');
        if (ctx2) {
            console.log('📊 Category chart canvas found');
            createCategoryChart(ctx2);
        }

        // Chart 3: Yearly Comparison
        const ctx3 = document.getElementById('yearlyComparisonChart');
        if (ctx3) {
            console.log('📊 Yearly chart canvas found');
            createYearlyChart(ctx3);
        }
    }

    function createMonthlyChart(ctx) {
        try {
            const data = {
                labels: {!! json_encode($allTimeData['labels'] ?? ['Jan', 'Feb', 'Mar']) !!},
                datasets: [
                    {
                        label: 'Pengaduan',
                        data: {!! json_encode($allTimeData['datasets']['pengaduan'] ?? [10, 20, 30]) !!},
                        backgroundColor: '#EF4444',
                        borderColor: '#DC2626',
                        borderWidth: 1
                    }
                ]
            };

            new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
            console.log('✅ Monthly chart created');
        } catch (error) {
            console.error('❌ Monthly chart error:', error);
        }
    }

    function createCategoryChart(ctx) {
        try {
            const data = {
                labels: {!! json_encode($categoryDistribution['labels'] ?? ['A', 'B', 'C']) !!},
                datasets: [{
                    data: {!! json_encode($categoryDistribution['data'] ?? [10, 20, 30]) !!},
                    backgroundColor: {!! json_encode($categoryDistribution['colors'] ?? ['#EF4444', '#3B82F6', '#10B981']) !!},
                    borderWidth: 2
                }]
            };

            new Chart(ctx, {
                type: 'doughnut',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
            console.log('✅ Category chart created');
        } catch (error) {
            console.error('❌ Category chart error:', error);
        }
    }

    function createYearlyChart(ctx) {
        try {
            const data = {
                labels: {!! json_encode($yearlyComparison['labels'] ?? ['2024', '2025']) !!},
                datasets: [{
                    label: 'Data',
                    data: {!! json_encode($yearlyComparison['currentYear'] ?? [100, 150]) !!},
                    backgroundColor: '#3B82F6',
                    borderColor: '#1D4ED8',
                    borderWidth: 1
                }]
            };

            new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
            console.log('✅ Yearly chart created');
        } catch (error) {
            console.error('❌ Yearly chart error:', error);
        }
    }
</script>
@endpush