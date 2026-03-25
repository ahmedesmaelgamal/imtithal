<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusReport extends BaseModel
{
    protected $table = 'bus_reports';

    protected $guarded = [];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
