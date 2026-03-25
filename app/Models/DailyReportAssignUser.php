<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyReportAssignUser extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'daily_report_id',
        'user_id',
        'deadline',
        'status',
        'axis_id',
        'area_id',
        'leader_id'
    ];


    public function answers()
    {
        return $this->hasMany(DailyAssignUserAnswer::class, 'daily_report_assign_user_id', 'id');
    }

    public function questions()
    {
        return $this->hasMany(AxisQuestion::class, 'axis_id', 'axis_id');
    }


    public function dailyReport()
    {
        return $this->belongsTo(DailyReport::class, 'daily_report_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function axis()
    {
        return $this->belongsTo(Axis::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');

    }
}
