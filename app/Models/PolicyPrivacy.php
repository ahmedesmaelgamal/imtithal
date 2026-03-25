<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PolicyPrivacy extends BaseModel
{
    use HasFactory;

    protected $table = 'policy_privacy';

    protected $fillable = [
        'title',
        'body',
        'type',
    ];


}
