<?php

namespace App\Http\Resources\Leaders;

use App\Enum\TaskStatusEnum;
use App\Http\Resources\Users\AreaResource;
use App\Http\Resources\Users\TasksResource;
use App\Http\Resources\Users\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaderTasksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
			"main_task"=> TaskResource::make($this->task),
			"deadline"=> $this->deadline,
			"status"=> (int) $this->status,
            'area'=> AreaResource::make($this->area),
            "status_name"=> TaskStatusEnum::from($this->status)->lang(),
			"created_at"=> $this->created_at,
			"updated_at"=> $this->updated_at,
            "leader"=> LeaderResource::make($this->leader),
			"user"=> UserResource::make($this->user),
            "task_question"=> LeaderTasksQuestionResource::collection($this->task->taskQuestions),
            "task_answers"=> LeaderTasksAnswerResource::collection($this->taskAnswers),
        ];
    }
}
