<?php

namespace App\Http\Resources\Leaders;

use App\Enum\AnswerStatusEnum;
use App\Enum\GlobalStatusEnum;
use App\Enum\TaskStatusEnum;
use App\Http\Resources\Users\AreaResource;
use App\Http\Resources\Users\UserResource;
use App\Models\TaskAnswerFile;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaderTasksAnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $files = TaskAnswerFile::query()
        ->where('task_question_id', $this->task_question_id)
        ->where('task_assign_id', $this->task_assign_id)
        ->select(['id','file','file_type'])
        ->get();
        return [
            "id" => $this->id,
            "task_question" => LeaderTasksQuestionResource::make($this->taskQuestion),
            "question_answer" => LeaderTasksQuestionAnswerResource::make($this->questionAnswer),
            "status" => (int) $this->status,
            "status_name" => AnswerStatusEnum::from($this->status)->lang(),
            "refuse_reason" => $this->refuseReason,
            "refuse_reason_notes" => $this->refuse_reason_notes,
            "files" => $files
        ];
    }
}
