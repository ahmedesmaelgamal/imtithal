<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketReplyResource extends JsonResource
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
            'reply' => $this->reply,
            'admin' => TicketReplyAdminResource::make($this->admin),
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
        ];

    }
}
