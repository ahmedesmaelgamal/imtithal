<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     *
     */

    public function routeNotificationForOneSignal()
    {
        return $this->fcm_token;
    }
    protected $fillable = [
        'full_name',
        'national_id',
        'image',
        'phone',
        'email',
        'fcm_token',
        'jwt_token',
        'password',
        'otp',
        'is_active',
        'otp_expire',
        'status',
        'delete_reason'
    ];

    public function areas()
    {
        return $this->hasMany(AreaTeam::class);
    }

    public function leaderReports()
    {
        return $this->hasMany(DailyReportAssignUser::class, 'leader_id', 'id');
    }

    public function userDailyReports()
    {
        return $this->hasMany(DailyReportAssignUser::class, 'user_id', 'id');
    }

    public function userNotices()
    {
        return $this->hasMany(Notice::class, 'user_id', 'id');
    }

    public function violationReports()
    {
        return $this->hasMany(ViolationReport::class, 'user_id', 'id');
    }

    public function alerts()
    {
        return $this->hasMany(AlertUser::class, 'user_id', 'id');
    }

    public function leaderalerts()
    {
        return $this->hasMany(AlertLeader::class, 'leader_id', 'id');
    }

    public function leaderNotices()
    {
        return $this->hasMany(Notice::class, 'leader_id', 'id');
    }


    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'user_id', 'id');
    }

    public function attendanceStats()
    {
        return $this->hasOne(Attendance::class, 'user_id', 'id')
            ->withoutGlobalScope('order') // Remove if you have an order scope
            ->selectRaw('user_id, 
            COUNT(*) as total_days,
            SUM(CASE WHEN checkin IS NOT NULL THEN 1 ELSE 0 END) as days_checked_in,
            SUM(CASE WHEN checkout IS NOT NULL THEN 1 ELSE 0 END) as days_checked_out')
            ->groupBy('user_id');
    }

    public function attendancesDay()
    {
        return $this->HasOne(Attendance::class, 'user_id', 'id')
            ->whereDate('date', Carbon::now()->format('Y-m-d'));
    }

    public function attendancesLastTwoDays()
    {
        return $this->hasMany(Attendance::class, 'user_id', 'id')
            ->select('date', 'checkin', 'checkout')
            ->whereDate('date', '>=', Carbon::now()->subDays(2)->format('Y-m-d'));
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
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


    public function setting()
    {
        return $this->hasMany(UserSetting::class, 'user_id', 'id');
    }
}
