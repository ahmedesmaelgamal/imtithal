<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralReport extends BaseModel
{
    use HasFactory;

    protected $table = 'general_reports';

    protected $fillable = ['title', 'description', 'extra', 'leader_id', 'admin_id','status','refuse_reason','refuse_notes'];


    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

}
