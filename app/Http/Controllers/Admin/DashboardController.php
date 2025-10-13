<?php
// app/Http\Controllers\Admin\DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GratifikasiReport;
use App\Models\WhistleBlowingReport;
use App\Models\NarkobaReport;
use App\Models\KritikSaranReport;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'gratifikasi' => [
                'total' => GratifikasiReport::count(),
                'today' => GratifikasiReport::whereDate('created_at', today())->count(),
                'month' => GratifikasiReport::whereMonth('created_at', now()->month)->count(),
            ],
            'whistleblowing' => [
                'total' => WhistleBlowingReport::count(),
                'today' => WhistleBlowingReport::whereDate('created_at', today())->count(),
                'month' => WhistleBlowingReport::whereMonth('created_at', now()->month)->count(),
            ],
            'narkoba' => [
                'total' => NarkobaReport::count(),
                'today' => NarkobaReport::whereDate('created_at', today())->count(),
                'month' => NarkobaReport::whereMonth('created_at', now()->month)->count(),
            ],
            'kritiksaran' => [
                'total' => KritikSaranReport::count(),
                'today' => KritikSaranReport::whereDate('created_at', today())->count(),
                'month' => KritikSaranReport::whereMonth('created_at', now()->month)->count(),
            ],
        ];

        return view('admin.dashboard', compact('stats'));
    }
}