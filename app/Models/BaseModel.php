<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    use LogsActivity;


    protected static function booted(): void
    {


        static::addGlobalScope('active', function (Builder $builder) {
            $obj = Season::where('status', 1)->first();
            // $builder->where('season_id', $obj ? $obj->id : 1);
        });


        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });


        static::creating(function ($model) {
            // if (isset($model->season_id) && empty($model->season_id)) {
            //     $obj = Season::where('status', 1)->first();
            //     $model->season_id = $obj ? $obj->id : 1;
            // }
        });

        static::updating(function ($model) {
            // if (isset($model->season_id) && empty($model->season_id)) {
            //     $obj = Season::where('status', 1)->first();
            //     $model->season_id = $obj ? $obj->id : 1;
            // }
        });
    }
}
