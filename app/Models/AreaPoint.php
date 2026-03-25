<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AreaPoint extends Model
{
    protected $fillable = [
        'area_id',
        'start_point_lat',
        'start_point_long',
        'end_point_lat',
        'end_point_long',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
