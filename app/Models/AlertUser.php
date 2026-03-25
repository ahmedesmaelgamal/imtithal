<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlertUser extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'alert_id',
        'seen',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alert()
    {
        return $this->belongsTo(Alert::class);
    }


}
