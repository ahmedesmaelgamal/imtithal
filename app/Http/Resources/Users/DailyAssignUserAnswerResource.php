<?php

namespace App\Http\Resources\Users;

use App\Http\Resources\MediaResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyAssignUserAnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int)$this->id,
            'answer' => $this->answer,
            'question_answer' => new AxisQuestionAnswerResource($this->questionAnswer),
            'status' => (int)$this->status,
            'user_id' => (int)$this->user_id,
            'refuse_reason' => $this->refuse_reason,
            'refuse_notice' => $this->refuse_notice,
            'answer_files' => MediaResource::collection($this->media),
        ];
    }
}
