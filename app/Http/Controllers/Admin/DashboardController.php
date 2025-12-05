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
        // Hitung statistik lengkap
        $stats = $this->calculateAllStats();
        
        // Total semua layanan
        $totalAllLayanan = 
            $stats['pengaduan']['total'] +
            $stats['ppid']['total'] +
            $stats['rehabilitasi']['total'] +
            $stats['kegiatan']['total'];
        
        // Data untuk chart
        $chartData = $this->getChartData($stats);
        
        // Aktivitas terbaru
        $recentActivities = $this->getRecentActivities();
        
        return view('admin.dashboard', compact(
            'stats', 
            'totalAllLayanan',
            'chartData',
            'recentActivities'
        ));
    }
    
    private function calculateAllStats()
    {
        return [
            'pengaduan' => $this->getPengaduanStats(),
            'ppid' => $this->getPpidStats(),
            'rehabilitasi' => $this->getRehabilitasiStats(),
            'kegiatan' => $this->getKegiatanStats(),
        ];
    }
    
    private function getPengaduanStats()
    {
        $models = [
            'gratifikasi' => GratifikasiReport::class,
            'whistleblowing' => WhistleBlowingReport::class,
            'narkoba' => NarkobaReport::class,
            'kritiksaran' => KritikSaranReport::class
        ];
        
        $stats = [];
        $total = 0;
        $today = 0;
        $week = 0;
        $month = 0;
        
        foreach ($models as $key => $model) {
            $stats[$key] = [
                'total' => $model::count(),
                'today' => $model::whereDate('created_at', today())->count(),
                'week' => $model::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
                'month' => $model::whereMonth('created_at', now()->month)->count(),
                'growth' => $this->calculateGrowth($model)
            ];
            
            $total += $stats[$key]['total'];
            $today += $stats[$key]['today'];
            $week += $stats[$key]['week'];
            $month += $stats[$key]['month'];
        }
        
        return [
            'total' => $total,
            'today' => $today,
            'week' => $week,
            'month' => $month,
            'growth' => $this->calculateGrowthForTotal($models),
            'details' => $stats
        ];
    }
    
    private function getPpidStats()
    {
        return [
            'total' => PpidRequest::count(),
            'today' => PpidRequest::whereDate('created_at', today())->count(),
            'week' => PpidRequest::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'month' => PpidRequest::whereMonth('created_at', now()->month)->count(),
            'growth' => $this->calculateGrowth(PpidRequest::class)
        ];
    }
    
    private function getRehabilitasiStats()
    {
        return [
            'total' => Rehabilitasi::count(),
            'today' => Rehabilitasi::whereDate('created_at', today())->count(),
            'week' => Rehabilitasi::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
            'month' => Rehabilitasi::whereMonth('created_at', now()->month)->count(),
            'growth' => $this->calculateGrowth(Rehabilitasi::class)
        ];
    }
    
    private function getKegiatanStats()
    {
        $models = [
            'magang' => Magang::class,
            'tat' => Tat::class,
            'sosialisasi' => Sosialisasi::class,
            'tes_urine' => TesUrineMandiri::class
        ];
        
        $stats = [];
        $total = 0;
        $today = 0;
        $week = 0;
        $month = 0;
        
        foreach ($models as $key => $model) {
            $stats[$key] = [
                'total' => $model::count(),
                'today' => $model::whereDate('created_at', today())->count(),
                'week' => $model::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
                'month' => $model::whereMonth('created_at', now()->month)->count(),
                'growth' => $this->calculateGrowth($model)
            ];
            
            $total += $stats[$key]['total'];
            $today += $stats[$key]['today'];
            $week += $stats[$key]['week'];
            $month += $stats[$key]['month'];
        }
        
        return [
            'total' => $total,
            'today' => $today,
            'week' => $week,
            'month' => $month,
            'growth' => $this->calculateGrowthForTotal($models),
            'details' => $stats
        ];
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
    
    private function calculateGrowthForTotal($models)
    {
        $todayTotal = 0;
        $yesterdayTotal = 0;
        
        foreach ($models as $model) {
            $todayTotal += $model::whereDate('created_at', today())->count();
            $yesterdayTotal += $model::whereDate('created_at', today()->subDay())->count();
        }
        
        if ($yesterdayTotal == 0) {
            return $todayTotal > 0 ? 100 : 0;
        }
        
        return round((($todayTotal - $yesterdayTotal) / $yesterdayTotal) * 100, 2);
    }
    
    private function getChartData($stats)
    {
        return [
            'total' => [
                'labels' => ['Pengaduan Masyarakat', 'PPID', 'Rehabilitasi', 'Kegiatan'],
                'datasets' => [
                    [
                        'label' => 'Total Data',
                        'data' => [
                            $stats['pengaduan']['total'],
                            $stats['ppid']['total'],
                            $stats['rehabilitasi']['total'],
                            $stats['kegiatan']['total']
                        ],
                        'backgroundColor' => [
                            'rgba(239, 68, 68, 0.7)',
                            'rgba(59, 130, 246, 0.7)',
                            'rgba(16, 185, 129, 0.7)',
                            'rgba(139, 92, 246, 0.7)'
                        ],
                        'borderColor' => [
                            'rgb(239, 68, 68)',
                            'rgb(59, 130, 246)',
                            'rgb(16, 185, 129)',
                            'rgb(139, 92, 246)'
                        ]
                    ]
                ]
            ],
            'monthly' => [
                'labels' => ['Pengaduan Masyarakat', 'PPID', 'Rehabilitasi', 'Kegiatan'],
                'datasets' => [
                    [
                        'label' => 'Bulan Ini',
                        'data' => [
                            $stats['pengaduan']['month'],
                            $stats['ppid']['month'],
                            $stats['rehabilitasi']['month'],
                            $stats['kegiatan']['month']
                        ],
                        'backgroundColor' => [
                            'rgba(239, 68, 68, 0.5)',
                            'rgba(59, 130, 246, 0.5)',
                            'rgba(16, 185, 129, 0.5)',
                            'rgba(139, 92, 246, 0.5)'
                        ],
                        'borderColor' => [
                            'rgb(239, 68, 68)',
                            'rgb(59, 130, 246)',
                            'rgb(16, 185, 129)',
                            'rgb(139, 92, 246)'
                        ]
                    ]
                ]
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
}