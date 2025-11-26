<?php
// app/Http\Controllers\Admin\DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GratifikasiReport;
use App\Models\WhistleBlowingReport;
use App\Models\NarkobaReport;
use App\Models\KritikSaranReport;
use App\Models\PpidRequest;
use App\Models\Rehabilitasi;
use App\Models\Magang;
use App\Models\Tat;
use App\Models\Sosialisasi;
use App\Models\TesUrineMandiri;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Layanan Pengaduan Masyarakat
        $stats = [
            'pengaduan' => [
                'gratifikasi' => [
                    'total' => GratifikasiReport::count(),
                    'today' => GratifikasiReport::whereDate('created_at', today())->count(),
                    'week' => GratifikasiReport::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
                    'month' => GratifikasiReport::whereMonth('created_at', now()->month)->count(),
                    'growth' => $this->calculateGrowth(GratifikasiReport::class)
                ],
                'whistleblowing' => [
                    'total' => WhistleBlowingReport::count(),
                    'today' => WhistleBlowingReport::whereDate('created_at', today())->count(),
                    'week' => WhistleBlowingReport::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
                    'month' => WhistleBlowingReport::whereMonth('created_at', now()->month)->count(),
                    'growth' => $this->calculateGrowth(WhistleBlowingReport::class)
                ],
                'narkoba' => [
                    'total' => NarkobaReport::count(),
                    'today' => NarkobaReport::whereDate('created_at', today())->count(),
                    'week' => NarkobaReport::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
                    'month' => NarkobaReport::whereMonth('created_at', now()->month)->count(),
                    'growth' => $this->calculateGrowth(NarkobaReport::class)
                ],
                'kritiksaran' => [
                    'total' => KritikSaranReport::count(),
                    'today' => KritikSaranReport::whereDate('created_at', today())->count(),
                    'week' => KritikSaranReport::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
                    'month' => KritikSaranReport::whereMonth('created_at', now()->month)->count(),
                    'growth' => $this->calculateGrowth(KritikSaranReport::class)
                ],
            ],
            
            // Layanan PPID
            'ppid' => [
                'total' => PpidRequest::count(),
                'today' => PpidRequest::whereDate('created_at', today())->count(),
                'week' => PpidRequest::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
                'month' => PpidRequest::whereMonth('created_at', now()->month)->count(),
                'growth' => $this->calculateGrowth(PpidRequest::class)
            ],
            
            // Layanan Rehabilitasi
            'rehabilitasi' => [
                'total' => Rehabilitasi::count(),
                'today' => Rehabilitasi::whereDate('created_at', today())->count(),
                'week' => Rehabilitasi::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
                'month' => Rehabilitasi::whereMonth('created_at', now()->month)->count(),
                'growth' => $this->calculateGrowth(Rehabilitasi::class)
            ],
            
            // Layanan Kegiatan - DETAILED
            'kegiatan' => [
                'magang' => [
                    'total' => Magang::count(),
                    'today' => Magang::whereDate('created_at', today())->count(),
                    'week' => Magang::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
                    'month' => Magang::whereMonth('created_at', now()->month)->count(),
                    'growth' => $this->calculateGrowth(Magang::class)
                ],
                'tat' => [
                    'total' => Tat::count(),
                    'today' => Tat::whereDate('created_at', today())->count(),
                    'week' => Tat::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
                    'month' => Tat::whereMonth('created_at', now()->month)->count(),
                    'growth' => $this->calculateGrowth(Tat::class)
                ],
                'sosialisasi' => [
                    'total' => Sosialisasi::count(),
                    'today' => Sosialisasi::whereDate('created_at', today())->count(),
                    'week' => Sosialisasi::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
                    'month' => Sosialisasi::whereMonth('created_at', now()->month)->count(),
                    'growth' => $this->calculateGrowth(Sosialisasi::class)
                ],
                'tes_urine' => [
                    'total' => TesUrineMandiri::count(),
                    'today' => TesUrineMandiri::whereDate('created_at', today())->count(),
                    'week' => TesUrineMandiri::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
                    'month' => TesUrineMandiri::whereMonth('created_at', now()->month)->count(),
                    'growth' => $this->calculateGrowth(TesUrineMandiri::class)
                ],
            ]
        ];

        // Statistik Pengunjung Website (dummy data untuk sementara)
        $visitorStats = $this->getVisitorStats();

        // Total Semua Layanan
        $totalAllLayanan = 
            $stats['pengaduan']['gratifikasi']['total'] +
            $stats['pengaduan']['whistleblowing']['total'] +
            $stats['pengaduan']['narkoba']['total'] +
            $stats['pengaduan']['kritiksaran']['total'] +
            $stats['ppid']['total'] +
            $stats['rehabilitasi']['total'] +
            $stats['kegiatan']['magang']['total'] +
            $stats['kegiatan']['tat']['total'] +
            $stats['kegiatan']['sosialisasi']['total'] +
            $stats['kegiatan']['tes_urine']['total'];

        // Data untuk Chart
        $allTimeData = $this->getAllTimeData();
        $categoryDistribution = $this->getCategoryDistribution();
        $yearlyComparison = $this->getYearlyComparison();
        
        // Aktivitas Terbaru
        $recentActivities = $this->getRecentActivities();

        // HAPUS $weeklyData karena tidak digunakan
        return view('admin.dashboard', compact(
            'stats', 
            'totalAllLayanan',
            'recentActivities',
            'visitorStats',
            'allTimeData',
            'categoryDistribution',
            'yearlyComparison'
        ));
    }

    private function calculateGrowth($model)
    {
        $todayCount = $model::whereDate('created_at', today())->count();
        $yesterdayCount = $model::whereDate('created_at', today()->subDay())->count();
        
        if ($yesterdayCount == 0) {
            return $todayCount > 0 ? 100 : 0;
        }
        
        return round((($todayCount - $yesterdayCount) / $yesterdayCount) * 100, 2);
    }

    private function getAllTimeData()
    {
        // Data bulanan untuk 12 bulan terakhir
        $monthlyData = [
            'labels' => [],
            'datasets' => [
                'pengaduan' => [],
                'ppid' => [],
                'rehabilitasi' => [],
                'kegiatan' => []
            ]
        ];
        
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthLabel = $date->format('M Y');
            
            $monthlyData['labels'][] = $monthLabel;
            
            // Pengaduan
            $monthlyData['datasets']['pengaduan'][] = 
                GratifikasiReport::whereYear('created_at', $date->year)
                            ->whereMonth('created_at', $date->month)
                            ->count() +
                WhistleBlowingReport::whereYear('created_at', $date->year)
                              ->whereMonth('created_at', $date->month)
                              ->count() +
                NarkobaReport::whereYear('created_at', $date->year)
                        ->whereMonth('created_at', $date->month)
                        ->count() +
                KritikSaranReport::whereYear('created_at', $date->year)
                           ->whereMonth('created_at', $date->month)
                           ->count();

            // PPID
            $monthlyData['datasets']['ppid'][] = 
                PpidRequest::whereYear('created_at', $date->year)
                      ->whereMonth('created_at', $date->month)
                      ->count();

            // Rehabilitasi
            $monthlyData['datasets']['rehabilitasi'][] = 
                Rehabilitasi::whereYear('created_at', $date->year)
                       ->whereMonth('created_at', $date->month)
                       ->count();

            // Kegiatan
            $monthlyData['datasets']['kegiatan'][] = 
                Magang::whereYear('created_at', $date->year)
                  ->whereMonth('created_at', $date->month)
                  ->count() +
                Tat::whereYear('created_at', $date->year)
               ->whereMonth('created_at', $date->month)
               ->count() +
                Sosialisasi::whereYear('created_at', $date->year)
                      ->whereMonth('created_at', $date->month)
                      ->count() +
                TesUrineMandiri::whereYear('created_at', $date->year)
                          ->whereMonth('created_at', $date->month)
                          ->count();
        }

        return $monthlyData;
    }

    private function getCategoryDistribution()
    {
        // Distribusi per kategori untuk pie chart
        return [
            'labels' => ['Gratifikasi', 'Whistleblowing', 'Narkoba', 'Kritik & Saran', 'PPID', 'Rehabilitasi', 'Magang', 'TAT', 'Sosialisasi', 'Tes Urine'],
            'data' => [
                GratifikasiReport::count(),
                WhistleBlowingReport::count(),
                NarkobaReport::count(),
                KritikSaranReport::count(),
                PpidRequest::count(),
                Rehabilitasi::count(),
                Magang::count(),
                Tat::count(),
                Sosialisasi::count(),
                TesUrineMandiri::count()
            ],
            'colors' => [
                '#EF4444', '#F59E0B', '#8B5CF6', '#EC4899', 
                '#3B82F6', '#10B981', '#06B6D4', '#84CC16', 
                '#F97316', '#6B7280'
            ]
        ];
    }

    private function getYearlyComparison()
    {
        // Perbandingan tahun ini vs tahun lalu
        $currentYear = now()->year;
        $lastYear = $currentYear - 1;
        
        $currentYearData = [
            'pengaduan' => 
                GratifikasiReport::whereYear('created_at', $currentYear)->count() +
                WhistleBlowingReport::whereYear('created_at', $currentYear)->count() +
                NarkobaReport::whereYear('created_at', $currentYear)->count() +
                KritikSaranReport::whereYear('created_at', $currentYear)->count(),
            'ppid' => PpidRequest::whereYear('created_at', $currentYear)->count(),
            'rehabilitasi' => Rehabilitasi::whereYear('created_at', $currentYear)->count(),
            'kegiatan' => 
                Magang::whereYear('created_at', $currentYear)->count() +
                Tat::whereYear('created_at', $currentYear)->count() +
                Sosialisasi::whereYear('created_at', $currentYear)->count() +
                TesUrineMandiri::whereYear('created_at', $currentYear)->count()
        ];
        
        $lastYearData = [
            'pengaduan' => 
                GratifikasiReport::whereYear('created_at', $lastYear)->count() +
                WhistleBlowingReport::whereYear('created_at', $lastYear)->count() +
                NarkobaReport::whereYear('created_at', $lastYear)->count() +
                KritikSaranReport::whereYear('created_at', $lastYear)->count(),
            'ppid' => PpidRequest::whereYear('created_at', $lastYear)->count(),
            'rehabilitasi' => Rehabilitasi::whereYear('created_at', $lastYear)->count(),
            'kegiatan' => 
                Magang::whereYear('created_at', $lastYear)->count() +
                Tat::whereYear('created_at', $lastYear)->count() +
                Sosialisasi::whereYear('created_at', $lastYear)->count() +
                TesUrineMandiri::whereYear('created_at', $lastYear)->count()
        ];
        
        return [
            'labels' => ['Pengaduan', 'PPID', 'Rehabilitasi', 'Kegiatan'],
            'currentYear' => array_values($currentYearData),
            'lastYear' => array_values($lastYearData)
        ];
    }

    private function getVisitorStats()
    {
        // Contoh data pengunjung - sesuaikan dengan sistem tracking kamu
        return [
            'today' => [
                'count' => rand(100, 500),
                'growth' => rand(-10, 30)
            ],
            'week' => [
                'count' => rand(800, 2000),
                'growth' => rand(-5, 25)
            ],
            'month' => [
                'count' => rand(3000, 8000),
                'growth' => rand(0, 40)
            ],
            'total' => [
                'count' => rand(15000, 50000)
            ]
        ];
    }

    private function getRecentActivities()
    {
        $activities = [];

        $services = [
            ['model' => GratifikasiReport::class, 'icon' => 'exclamation-triangle', 'message' => 'Laporan Gratifikasi baru', 'color' => 'red'],
            ['model' => WhistleBlowingReport::class, 'icon' => 'shield-alt', 'message' => 'Laporan Whistleblowing baru', 'color' => 'orange'],
            ['model' => NarkobaReport::class, 'icon' => 'pills', 'message' => 'Laporan Narkoba baru', 'color' => 'purple'],
            ['model' => KritikSaranReport::class, 'icon' => 'comments', 'message' => 'Kritik dan Saran baru', 'color' => 'blue'],
            ['model' => PpidRequest::class, 'icon' => 'file-alt', 'message' => 'Permohonan PPID baru', 'color' => 'indigo'],
            ['model' => Rehabilitasi::class, 'icon' => 'heartbeat', 'message' => 'Permohonan Rehabilitasi baru', 'color' => 'green'],
            ['model' => Magang::class, 'icon' => 'user-graduate', 'message' => 'Permohonan Magang baru', 'color' => 'teal'],
            ['model' => Tat::class, 'icon' => 'chalkboard-teacher', 'message' => 'Permohonan TAT baru', 'color' => 'yellow'],
            ['model' => Sosialisasi::class, 'icon' => 'bullhorn', 'message' => 'Permohonan Sosialisasi baru', 'color' => 'pink'],
            ['model' => TesUrineMandiri::class, 'icon' => 'vial', 'message' => 'Permohonan Tes Urine baru', 'color' => 'gray'],
        ];

        foreach ($services as $service) {
            $recent = $service['model']::where('created_at', '>=', now()->subDay())->latest()->first();
            if ($recent) {
                $activities[] = [
                    'icon' => $service['icon'],
                    'message' => $service['message'],
                    'time' => $recent->created_at->diffForHumans(),
                    'color' => $service['color']
                ];
            }
        }

        usort($activities, function($a, $b) {
            return strtotime($b['time']) - strtotime($a['time']);
        });

        return array_slice($activities, 0, 5);
    }

    public function checkNewData()
    {
        $newData = [];
        $fiveMinutesAgo = now()->subMinutes(5);

        $services = [
            GratifikasiReport::class => 'laporan gratifikasi',
            WhistleBlowingReport::class => 'laporan whistleblowing', 
            NarkobaReport::class => 'laporan narkoba',
            KritikSaranReport::class => 'kritik dan saran',
            PpidRequest::class => 'permohonan PPID',
            Rehabilitasi::class => 'permohonan rehabilitasi',
            Magang::class => 'permohonan magang',
            Tat::class => 'permohonan TAT',
            Sosialisasi::class => 'permohonan sosialisasi',
            TesUrineMandiri::class => 'permohonan tes urine'
        ];

        foreach ($services as $model => $label) {
            $count = $model::where('created_at', '>=', $fiveMinutesAgo)->count();
            if ($count > 0) {
                $newData[] = $count . ' ' . $label . ' baru';
            }
        }

        return response()->json([
            'hasNewData' => count($newData) > 0,
            'messages' => $newData,
            'timestamp' => now()->toDateTimeString()
        ]);
    }
}