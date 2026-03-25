<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertLeader extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'alert_id',
        'leader_id',
        'seen'
    ];

    public function alert()
    {
        return $this->belongsTo(Alert::class);
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

}
