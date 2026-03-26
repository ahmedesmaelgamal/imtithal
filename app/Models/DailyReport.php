<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyReport extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'survey_id',
        'monitor_type',
        'side_type',
        'deadline',
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }

    public function surveyQuestions()
    {
        return $this->hasManyThrough(SurveyQuestion::class, Survey::class, 'id', 'survey_id', 'survey_id', 'id');
    }

    public function dailyReportAssignUser()
    {

        return $this->hasMany(DailyReportAssignUser::class);
    }

}
