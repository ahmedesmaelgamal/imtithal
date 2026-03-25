<?php

namespace App\Http\Resources\Users;

use App\Enum\TaskStatusEnum;
use App\Http\Resources\Leaders\LeaderResource;
use App\Http\Resources\Leaders\LeaderTasksAnswerResource;
use App\Http\Resources\Leaders\LeaderTasksQuestionResource;
use App\Http\Resources\Leaders\TaskResource;
use App\Http\Resources\Users\AreaResource;
use App\Http\Resources\Users\TasksResource;
use App\Http\Resources\Users\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskDetailResource extends JsonResource
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
            'progress'=> $this->task->taskQuestions->count() > 0 ? ($this->taskAnswers->count() / $this->task->taskQuestions->count()) * 100 : 0,
            'area'=> AreaResource::make($this->area),
            "status_name"=> TaskStatusEnum::from($this->status)->lang(),
			"created_at"=> $this->created_at,
			"updated_at"=> $this->updated_at,
            "leader"=> LeaderResource::make($this->leader),
			"user"=> UserResource::make($this->user),
            "task_question"=> LeaderTasksQuestionResource::collection($this->task->taskQuestions ?? null),
            "task_answers"=> LeaderTasksAnswerResource::collection($this->taskAnswers ?? null),
        ];
    }
}
