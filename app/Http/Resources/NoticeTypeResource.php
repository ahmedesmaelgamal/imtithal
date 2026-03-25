<?php

namespace App\Http\Resources;

use App\Enum\NoticeTypePriorityEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoticeTypeResource extends JsonResource
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
            'name' => $this->name,
            'priority'=>$this->priority,
            'priority_name' =>NoticeTypePriorityEnum::from($this->priority)->lang(),
            'period' => $this->period,
        ];
    }
}
