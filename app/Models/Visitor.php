<?php
// app/Models/Visitor.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip_address',
        'user_agent',
        'browser',
        'platform',
        'device',
        'country',
        'city',
        'referrer',
        'page_visited',
        'visit_date',
        'visit_time',
        'session_duration',
    ];

    protected $casts = [
        'visit_date' => 'date',
        'session_duration' => 'integer',
    ];

    // Scope untuk query yang sering digunakan
    public function scopeToday($query)
    {
        return $query->where('visit_date', today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('visit_date', [now()->startOfWeek(), now()->endOfWeek()]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereYear('visit_date', now()->year)
                    ->whereMonth('visit_date', now()->month);
    }

    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('visit_date', [$startDate, $endDate]);
    }

    // Method untuk statistik
    public static function getDailyStats($days = 30)
    {
        return self::selectRaw('DATE(visit_date) as date, COUNT(*) as count')
            ->where('visit_date', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->pluck('count', 'date');
    }

    public static function getMonthlyStats($months = 12)
    {
        return self::selectRaw('YEAR(visit_date) as year, MONTH(visit_date) as month, COUNT(*) as count')
            ->where('visit_date', '>=', now()->subMonths($months))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->mapWithKeys(function ($item) {
                $key = $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT);
                return [$key => $item->count];
            });
    }
}