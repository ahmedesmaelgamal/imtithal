<?php

namespace App\Http\Resources\Leaders;

use App\Enum\TaskQuestionEnum;
use App\Enum\DailyReportAssignUserStatusEnum;
use App\Http\Resources\Users\AreaResource;
use App\Http\Resources\Users\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaderTasksQuestionResource extends JsonResource
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
            'answer_type' => $this->answer_type,
            'require_file' => $this->require_file,
            'parent_id' => $this->parent_id,
            'order_number' => $this->order_number,
        ];

    }
}
