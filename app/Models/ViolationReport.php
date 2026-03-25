<?php

namespace App\Models;

use App\Enum\VehicleType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViolationReport extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'reference_number',
        'violation_time',
        'violation_date',
        'map_url',
        'lat',
        'long',
        'plate_number',
        'plate_letter_ar',
        'plate_letter_en',
        'plate_image',
        'vehicle_type',
        'violation_image',
        'violation_video',
        'user_id',
        'admin_id',
        'user_type',
        'status',
        'refuse_reason',
        'refuse_notes'
    ];

//    protected $casts = [
//        'vehicle_type' => VehicleType::class,
//    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function areaTeam()
    {
        return $this->belongsTo(AreaTeam::class,'user_id','user_id');
    }


}
