<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends BaseModel
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = [
        'title',
        'description',

    ];

    // public function parent()
    // {
    //     return $this->belongsTo(AxisQuestion::class);
    // }

    public function answers()
    {
        return $this->hasMany(QuestionAnswer::class, 'survey_id', 'id');
    }

    public function questionUserAnswers()
    {
        return $this->hasMany(DailyAssignUserAnswer::class, 'survey_id', 'id');
    }

    public function surveyQuestions()
    {
        return $this->hasMany(SurveyQuestion::class, 'survey_id', 'id');
    }
}
