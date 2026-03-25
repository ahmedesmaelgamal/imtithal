<?php

namespace App\Http\Resources\Map;

use App\Models\QuestionAnswer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MapAxisQuestionPercentageResource extends JsonResource
{
    protected $usersAnswers;
    protected $yesAnswers;
    protected $noAnswers;

    public function setAnswers($usersAnswers, $yesAnswers, $noAnswers)
    {
        $this->usersAnswers = $usersAnswers;
        $this->yesAnswers = $yesAnswers;
        $this->noAnswers = $noAnswers;
        return $this;
    }

    public function toArray(Request $request): array
    {
        return [
            'id' => (int)$this->id,
            'question' => $this->question,
            'totalAnswers' => $this->usersAnswers?->where('axis_question_id', $this->id)->count() ?? 0,
            'yesAnswers' => $this->yesAnswers?->where('axis_question_id', $this->id)->count() ?? 0,
            'noAnswers' => $this->noAnswers?->where('axis_question_id', $this->id)->count() ?? 0
        ];
    }

}
