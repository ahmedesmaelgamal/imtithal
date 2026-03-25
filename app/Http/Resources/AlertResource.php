<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlertResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = auth('user')->user();
        $alertLeader = $this->alertLeaders()->where('leader_id', $user->id)->first();
        $alertUser = $this->alertUsers()->where('user_id', $user->id)->first();

        return [
            'id' => (int)$this->id,
            'title' => $this->title,
            'body' => $this->body,
            'type' => $this->type,
            'created_at' => $this->created_at->diffForHumans(),
            'leader_id' => $this->leader_id ? (int)$this->leader_id : null,
            'priority' => $this->priority,
            'user_type' => $this->user_type,
            'notification_type' => $this->notification_type,
            'seen' => $alertLeader
                ? (int)$alertLeader->seen
                : ($alertUser ? (int)$alertUser->seen : 0)
        ];
    }

}
