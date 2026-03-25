<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyAssignUserAnswer extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'daily_report_assign_user_id',
        'axis_question_id',
        'answer',
        'question_answer_id',
        'status',
        'user_id',
        'refuse_reason',
        'refuse_notice',
    ];


    public function dailyAssignUser()
    {
        return $this->belongsTo(DailyReportAssignUser::class);

    }

    public function axisQuestion()
    {
        return $this->belongsTo(AxisQuestion::class);
    }

    public function questionAnswer()
    {
        return $this->belongsTo(QuestionAnswer::class);

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

}
