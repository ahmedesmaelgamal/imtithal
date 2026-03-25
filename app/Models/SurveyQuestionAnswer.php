<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Added this line based on HasFactory usage

class SurveyQuestionAnswer extends BaseModel // Changed from Model to BaseModel
{
    use HasFactory; // Added this line

    protected $fillable = [ // Added fillable array
        'survey_question_id',
        'answer',
    ];

    public function surveyQuestion() // Added relation
    {
        return $this->belongsTo(SurveyQuestion::class);
    }
}
