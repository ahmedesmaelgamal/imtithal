<?php

namespace App\Http\Resources;

use App\Http\Resources\Users\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseNoticeResource extends JsonResource
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
            'title'=>$this->suggestion_title??$this->noticeType->name,
            'description' => $this->description,
//            'date' => (new \DateTime($this->notice_date))->format('d F Y') . '، ' . (new \DateTime($this->notice_time))->format('H:i A'),
            'date' => $this->notice_time,
            'status' => (int)$this->status,


        ];
    }
}
