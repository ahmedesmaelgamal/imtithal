<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'full_name',
        'national_id',
        'phone',
        'email',
        'image',
        'password',
        'otp',
        'otp_expire',
        'status',
        'is_map'
    ];

    protected static function booted(): void
    {

        static::addGlobalScope('active', function (Builder $builder) {
            $obj = Season::where('status', 1)->first();
            // $builder->where('season_id', $obj ? $obj->id : 1);
        });


        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }



    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return [];
    }


//    public static function boot()
//    {
//        parent::boot();
//
//        static::created(function ($model) {
//            activity()
//                ->causedBy(auth()->user())
//                ->performedOn($model)
//                ->log('created');
//        });
//
//        static::updated(function ($model) {
//            activity()
//                ->causedBy(auth()->user())
//                ->performedOn($model)
//                ->log('updated');
//        });
//
//        static::deleted(function ($model) {
//            activity()
//                ->causedBy(auth()->user())
//                ->performedOn($model)
//                ->log('deleted');
//        });
//    }
}
