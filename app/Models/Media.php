<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'file',
        'file_type',
        'file_name',
        'model_type',
        'model_id',
    ];

    public function mediable()
    {
        return $this->morphTo();
    }
}
