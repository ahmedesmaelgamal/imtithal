<?php

namespace App\Http\Resources\Map;

use App\Enum\DailyReportRejectReasonEnum;
use App\Enum\map\MapNoticeStatusEnum;
use App\Enum\NoticeStatusEnum;
use App\Enum\NoticeTypePriorityEnum;
use App\Http\Resources\MediaResource;
use App\Http\Resources\NoticeTypeResource;
use App\Http\Resources\Users\UserResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MapNoticeDetailsResource extends JsonResource
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
            'title'=>$this->noticeType->name,
            'date' => Carbon::parse($this->notice_date)->locale('ar')->translatedFormat('F d Y'),
            'status' => (int)$this->status,
            'priority' => $this->noticeType->priority,
            'priority_name' => NoticeTypePriorityEnum::from($this->noticeType->priority)->lang(),
            'status_name' => MapNoticeStatusEnum::from($this->status)->lang(),
            'user' => $this->user_id?$this->user->full_name:$this->leader->full_name,

        ];
    }
}
