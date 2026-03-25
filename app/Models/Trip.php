<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'trip_number',
        'air_carrier',
        'departure_country',
        'readiness_list_number',
        'service_provider',
        'hajj_groups_count',
        'hajjis_count',
        'area_id',
        'arrival_date',
        'arrival_time',
        'executor',
        'contract_number',
        'residence_city',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
