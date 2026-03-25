<?php

namespace App\Models;

use Faker\Provider\Base;
use Illuminate\Database\Eloquent\Model;

class UserSetting extends BaseModel
{
    protected $table = 'user_settings';
    protected $fillable = [
        'user_id',
        'setting_id',
    ];
    protected $casts = [
        'user_id' => 'integer',
        'setting_id' => 'integer',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function setting()
    {
        return $this->belongsTo(Setting::class);
    }
}
