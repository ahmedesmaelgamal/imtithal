<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'checkin',
        'checkout',
        'checkin_lat',
        'checkin_long',
        'checkout_lat',
        'date',
        'checkout_long',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
