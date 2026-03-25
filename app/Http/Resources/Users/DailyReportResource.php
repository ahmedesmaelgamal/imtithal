<?php

namespace App\Http\Resources\Users;

use App\Enum\AnswerStatusEnum;
use App\Enum\DailyReportAssignUserStatusEnum;
use App\Enum\monitorType;
use App\Enum\SideType;
use App\Models\AxisQuestion;
use App\Models\DailyAssignUserAnswer;
use App\Models\DailyReportAssignUser;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $dailyReportAssignUser = DailyReportAssignUser::where('daily_report_id', $this->id)->first();

        $fullQuestions = AxisQuestion::where('axis_id', $this->axis_id)->get();

        $myAnswers=DailyAssignUserAnswer::where('daily_report_assign_user_id', $dailyReportAssignUser->id)->get();
        $myUnAnsweredQuestions = $fullQuestions->whereNotIn('id', $myAnswers->pluck('axis_question_id')->toArray());

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => (int)$this->status,
            'status_name' => DailyReportAssignUserStatusEnum::from($this->status)->lang(),
            'monitor_type' => monitorType::from($this->monitor_type)->lang(),
            'side_type' => SideType::from($this->side_type)->lang(),
            'axis' => new AxisResource($this->axis),
            'area' => new AreaResource($dailyReportAssignUser->area),
            'deadline' => (new \DateTime($this->deadline))->format('d-m-Y'),
            'progress' => (int)$this->progress,
            'daily_report_questions' => $this->status== 3?
                AxisQuestionResource::collection( $myUnAnsweredQuestions?? [])
                :AxisQuestionResource::collection($fullQuestions ?? []),
//            'my_daily_report_answers' => DailyAssignUserAnswerResource::collection($myAnswers ?? []),
        ];
    }
}
