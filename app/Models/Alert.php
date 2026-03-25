<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'type',
        'notification_type',
        'user_type',
        'leader_id',
        'admin_id',
        'to',
        'priority',
    ];


    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
    public function alertUsers()
    {
        return $this->hasMany(AlertUser::class);
    }

    public function alertLeaders()
    {
        return $this->hasMany(AlertLeader::class);
    }


    public function media()
    {
        return $this->morphMany('App\Models\Media', 'model');
    }

    public function scopeAlert($query)
    {
        return $query->where('type', 'alert');
    }

    public function scopeNotification($query)
    {
        return $query->where('type', 'notification');
    }





}
