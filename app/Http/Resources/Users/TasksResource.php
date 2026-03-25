<?php

namespace App\Http\Resources\Users;

use App\Enum\TaskStatusEnum;
use App\Http\Resources\Leaders\LeaderResource;
use App\Http\Resources\Leaders\LeaderTasksAnswerResource;
use App\Http\Resources\Leaders\LeaderTasksQuestionResource;
use App\Http\Resources\Leaders\TaskResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TasksResource extends JsonResource
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
            'title' => $this->title,
            'body' => $this->body,
        ];

    }
}
