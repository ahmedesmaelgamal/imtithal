<?php

namespace App\Http\Resources\Users;

use App\Enum\TaskQuestionEnum;
use App\Models\DailyAssignUserAnswer;
use App\Models\SurveyQuestionAnswer;
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
        $QuestionAnswers = SurveyQuestionAnswer::where('survey_question_id', $this->id)->get();
        return [
            'id' => $this->id,
            'question' => $this->question,
            'answer_type' => (int)$this->answer_type,
            'answer_type_name' => TaskQuestionEnum::from($this->answer_type)->lang(),
            'answers' => AxisQuestionAnswerResource::collection($QuestionAnswers),
            'require_file' => (int)$this->require_file,
            'order_number' => $this->order_number,
        ];
    }
}
