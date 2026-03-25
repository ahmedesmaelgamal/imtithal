<?php

namespace App\Http\Resources\Users;

use App\Enum\AnswerStatusEnum;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AxisQuestionAnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $files = Media::query()
            ->where('model_type', 'App\Models\AxisQuestionAnswer')
            ->where('model_id', $this->id)
            ->select(['id', 'file', 'file_type', 'file_name'])
            ->get();
        return [
            "id" => $this->id,
            'answer' => $this->answer,
            "status" => (int)$this->status,
            "status_name" => AnswerStatusEnum::from($this->status)->lang(),
            "refuse_reason" => $this->refuseReason,
            "refuse_notice" => $this->refuse_reason_notes,
//            "files" => $files
        ];
    }
}
