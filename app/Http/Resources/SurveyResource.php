<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SurveyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'questions'   => $this->whenLoaded('surveyQuestions', function () {
                return $this->surveyQuestions->map(function ($question) {
                    return [
                        'id'           => $question->id,
                        'question'     => $question->question,
                        'answer_type'  => $question->answer_type,
                        'require_file' => $question->require_file,
                        'order_number' => $question->order_number,
                        'answers'      => $question->answers->map(function ($answer) {
                            return [
                                'id'     => $answer->id,
                                'answer' => $answer->answer,
                            ];
                        }),
                    ];
                });
            }),
        ];
    }
}
