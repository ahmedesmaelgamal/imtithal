<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AxisQuestion extends BaseModel
{
    use HasFactory;
protected $guarded = [];
    // protected $fillable = [
    //     'question',
    //     'axis_id',
    //     'answer_type',
    //     'require_file',
    //     'true_parent_id',
    //     'false_parent_id',
    //     'order_number',
    // ];

    public function axis()
    {
        return $this->belongsTo(Axis::class);
    }

    public function parent()
    {
        return $this->belongsTo(AxisQuestion::class);
    }

    public function answers()
    {
        return $this->hasMany(QuestionAnswer::class,'axis_question_id','id');
    }

    public function questionUserAnswers()
    {
        return $this->hasMany(DailyAssignUserAnswer::class, 'axis_question_id', 'id');
    }
}
