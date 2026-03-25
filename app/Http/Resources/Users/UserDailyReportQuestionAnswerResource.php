<?php

namespace App\Http\Resources\Users;

use App\Enum\AnswerStatusEnum;
use App\Enum\DailyReportAssignUserStatusEnum;
use App\Enum\DailyReportRejectReasonEnum;
use App\Http\Resources\Leaders\LeaderTasksQuestionResource;
use App\Http\Resources\MediaResource;
use App\Http\Resources\Users\AreaResource;
use App\Http\Resources\Users\UserResource;
use AnswerFile;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDailyReportQuestionAnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'daily_report_assign_user_id' => $this->daily_report_assign_user_id,
            'axis_question' => LeaderTasksQuestionResource::make($this->axisQuestion),
            'answer' => $this->answer,
            'question_answer' => $this->questionAnswer,
            'question_answers' => $this->axisQuestion->answers,
            "status" => (int)$this->status,
            "status_name" => AnswerStatusEnum::from($this->status)->lang(),
            'refuse_reason' =>$this->refuse_reason? DailyReportRejectReasonEnum::from($this->refuse_reason)->lang():null,
            'refuse_notice' => $this->refuse_notice,
            'answer_files' => MediaResource::collection($this->media),
        ];
    }
}
