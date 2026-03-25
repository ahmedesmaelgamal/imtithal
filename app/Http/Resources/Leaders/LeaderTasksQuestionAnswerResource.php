<?php

namespace App\Http\Resources\Leaders;

use App\Enum\TaskStatusEnum;
use App\Http\Resources\Users\AreaResource;
use App\Http\Resources\Users\UserResource;
use App\Models\TaskAnswerFile;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaderTasksQuestionAnswerResource extends JsonResource
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
            'answer' => $this->answer,
        ];
    }
}
