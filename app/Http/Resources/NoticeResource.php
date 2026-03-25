<?php

namespace App\Http\Resources;

use App\Enum\DailyReportRejectReasonEnum;
use App\Enum\NoticeStatusEnum;
use App\Http\Resources\Users\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoticeResource extends JsonResource
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
            'user_type' => $this->user_type!==null?$this->user_type==0?'user':'leader':null,
            'lat' => $this->lat,
            'long' => $this->long,
            'date' => (new \DateTime($this->notice_date . ' ' . $this->notice_time))->format('d-m-Y h:i'),
            'status' => (int)$this->status,
            'status_name' => NoticeStatusEnum::from($this->status)->lang(),
            'refuse_reason' =>$this->refuse_reason? DailyReportRejectReasonEnum::from($this->refuse_reason)->lang():null,

            'refuse_notice' => $this->refuse_notice,
            'user_id' => new UserResource($this->user),
            'notice_type' => new NoticeTypeResource($this->noticeType),
            'files' => MediaResource::collection($this->media),

        ];
    }
}
