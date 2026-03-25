<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaTeam extends BaseModel
{

    use HasFactory;

    protected $fillable = [
        'area_id',
        'user_id',
        'type',
        'primary_leader'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
