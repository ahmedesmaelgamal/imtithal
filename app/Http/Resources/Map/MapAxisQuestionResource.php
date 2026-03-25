<?php

namespace App\Http\Resources\Map;

use App\Enum\TaskQuestionEnum;
use App\Http\Resources\Users\AxisQuestionAnswerResource;
use App\Http\Resources\Users\AxisResource;
use App\Http\Resources\Users\DailyAssignUserAnswerResource;
use App\Models\DailyAssignUserAnswer;
use App\Models\QuestionAnswer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MapAxisQuestionResource extends JsonResource
{
    protected $dailyReportAssignId;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function __construct($resource, $dailyReportAssignId = null)
    {
        parent::__construct($resource);
        $this->dailyReportAssignId = $dailyReportAssignId;
    }
    public function toArray(Request $request): array
    {
//        dd($this->dailyReportAssignId);
        $QuestionAnswers = QuestionAnswer::where('axis_question_id', $this->id)->get();
        $myDailyReportAnswers = DailyAssignUserAnswer::where('axis_question_id', $this->id)
            ->where('daily_report_assign_user_id', $this->dailyReportAssignId)
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
//            'parent' => $this->parent_id ? new MapAxisQuestionResource($this->parent) : null,
            'my_daily_report_answers' => DailyAssignUserAnswerResource::collection($myDailyReportAnswers),
        ];
    }
}
