<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'age', 'gender', 'origin', 'visit_date', 'notes',
    ];

    protected static function boot()
    {
        parent::boot();

        // Saat Visitor dibuat atau dihapus
        static::created(function ($visitor) {
            self::updateVisitorStats($visitor->visit_date);
        });

        static::deleted(function ($visitor) {
            self::updateVisitorStats($visitor->visit_date);
        });
    }

    public static function updateVisitorStats($visit_date)
    {
        // Hitung jumlah pengunjung berdasarkan tanggal
        $date = date('Y-m-d', strtotime($visit_date));
        $visitorCount = self::whereDate('visit_date', $date)->count();

        // Perbarui atau buat entry di tabel visitors_stats
        \App\Models\VisitorStat::updateOrCreate(
            ['date' => $date],
            ['visitor_count' => $visitorCount]
        );
    }
}
