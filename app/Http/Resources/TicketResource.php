<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int)$this->id,
            'priority' => $this->priority, // low, medium, high
            'subject' => $this->subject,
            'message' => $this->message,
            'status' => (int) $this->status,
//            'replies' => TicketReplyResource::collection($this->replies),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];

    }
}
