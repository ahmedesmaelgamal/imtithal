<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyReport extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'axis_id',
        'monitor_type',
        'side_type',
        'deadline',
    ];

    public function axis()
    {
        return $this->belongsTo(Axis::class);
    }



    public function dailyReportAssignUser()
    {

        return $this->hasMany(DailyReportAssignUser::class);
    }

    public function questions()
    {

        return $this->hasMany(AxisQuestion::class);

    }


}
