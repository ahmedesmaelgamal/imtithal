<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeType extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'priority',
        'period',
        'level',
    ];
}
