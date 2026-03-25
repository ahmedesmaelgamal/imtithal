<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $fillable = [
        'name',
        'status'
    ];

//    protected static function booted(): void
//    {
//        static::addGlobalScope('active', function (Builder $builder) {
//            $builder->orderBy('status', 1);
//        });
//    }
}
