<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends BaseModel
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'servay_questions';
    protected $fillable = [
        'survey_id',
        'question',
        'answer_type',
        'require_file',
        'order_number',
    ];

    // public function parent()
    // {
    //     return $this->belongsTo(AxisQuestion::class);
    // }

    public function answers()
    {
        return $this->hasMany(SurveyQuestionAnswer::class, 'survey_question_id', 'id');
    }

    public function questionUserAnswers()
    {
        return $this->hasMany(DailyAssignUserAnswer::class, 'survey_id', 'id');
    }

    public function survey()
    {
        return $this->belongsTo(Survey::class, 'survey_id', 'id');
    }
}
