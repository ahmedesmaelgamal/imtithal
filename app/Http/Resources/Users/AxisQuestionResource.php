<?php

namespace App\Http\Resources\Users;

use App\Enum\TaskQuestionEnum;
use App\Models\DailyAssignUserAnswer;
use App\Models\QuestionAnswer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AxisQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $QuestionAnswers = QuestionAnswer::where('axis_question_id', $this->id)->get();
        $myDailyReportAnswers = DailyAssignUserAnswer::where('axis_question_id', $this->id)
            ->where('daily_report_assign_user_id', )
            ->get();
        return [
            'id' => $this->id,
            'question' => $this->question,
            'axis' => new AxisResource($this->axis),
            'answer_type' => (int)$this->answer_type,
            'answer_type_name' => TaskQuestionEnum::from($this->answer_type)->lang(),
            'answers' => AxisQuestionAnswerResource::collection($QuestionAnswers),
            'require_file' => (int)$this->require_file,
            'order_number' => $this->order_number,
            'parent' => $this->parent_id ? new AxisQuestionResource($this->parent) : null,
            'my_daily_report_answers' => DailyAssignUserAnswerResource::collection($myDailyReportAnswers),
        ];
    }
}
