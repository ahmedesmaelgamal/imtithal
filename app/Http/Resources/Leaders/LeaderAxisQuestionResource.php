<?php

namespace App\Http\Resources\Leaders;

use App\Enum\TaskQuestionEnum;
use App\Http\Resources\Users\AxisQuestionAnswerResource;
use App\Http\Resources\Users\AxisResource;
use App\Models\DailyAssignUserAnswer;
use App\Models\DailyReportAssignUser;
use App\Models\QuestionAnswer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaderAxisQuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $QuestionAnswers = QuestionAnswer::where('axis_question_id', $this->id)->get();
        $daily_report_assign_user=DailyReportAssignUser::where('daily_report_id',$this->daily_report_id)
            ->where('user_id',$this->user_id)
            ->first();
        if (!is_null($this->user_id) && !is_null($this->daily_report_id)) {
            $daily_report_assign_user = DailyReportAssignUser::where('daily_report_id', $this->daily_report_id)
                ->where('user_id', $this->user_id)
                ->first();


            $myDailyReportAnswers = DailyAssignUserAnswer::where('axis_question_id', $this->id)
                ->where('daily_report_assign_user_id', $daily_report_assign_user->id)
                ->get();
        }else{

            $myDailyReportAnswers = DailyAssignUserAnswer::where('axis_question_id', $this->id)
                ->get();

        }

//        dd($myDailyReportAnswers->count());

        return [
            'id' => $this->id,
            'question' => $this->question,
            'axis' => new AxisResource($this->axis),
            'answer_type' => (int)$this->answer_type,
            'answer_type_name' => TaskQuestionEnum::from($this->answer_type)->lang(),
            'answers' => AxisQuestionAnswerResource::collection($QuestionAnswers),
            'require_file' => (int)$this->require_file,
            'order_number' => $this->order_number,
            'parent' => $this->parent_id ? new LeaderAxisQuestionResource($this->parent) : null,
            'my_daily_report_answers' =>is_null($this->user_id)? LeaderDailyAssignUserAnswerResource::collection([]):LeaderDailyAssignUserAnswerResource::collection($myDailyReportAnswers),
        ];
    }
}
