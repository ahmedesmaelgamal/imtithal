<?php

namespace App\Http\Resources\Users;

use App\Enum\TaskQuestionEnum;
use App\Enum\DailyReportAssignUserStatusEnum;
use App\Http\Resources\Users\AreaResource;
use App\Http\Resources\Users\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyReportQuestionResource extends JsonResource
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
            'question' => $this->question,
            'answer_type' => (int)$this->answer_type,
            'answer_type_name' => TaskQuestionEnum::from($this->answer_type)->lang(),
            'has_file' => $this->has_file,
            'order' => $this->order,
        ];
    }
}
