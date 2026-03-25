<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyReportAssign extends Model
{
    use HasFactory;

    protected $fillable = [
        'daily_report_id',
        'deadline',
    ];

    public function dailyReport()
    {
        return $this->belongsTo(DailyReport::class);
    }

}
