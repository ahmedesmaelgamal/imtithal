<?php

namespace App\Http\Resources\Map;

use App\Enum\NoticeTypePriorityEnum;
use App\Models\AlertUser;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MapAlertResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $alert = AlertUser::where('alert_id', $this->id);

        if ($alert->where('seen', 0)->exists()) {
            $seen = 0;
        } else {
            $seen = 1;
        }
        return [
            'id' => (int)$this->id,
            'title' => $this->title,
            'body' => $this->body,
            'priority' => $this->priority,
            'priority_name'=>NoticeTypePriorityEnum::from($this->priority)->lang(),
            'created_at' => $this->created_at->diffForHumans(),
            'sender' => $this->leader->full_name??null,
            'seen' => $this->seen,
        ];
    }

}
