<?php

namespace App\Http\Resources\Map;

use App\Enum\DailyReportRejectReasonEnum;
use App\Enum\NoticeStatusEnum;
use App\Enum\NoticeTypePriorityEnum;
use App\Http\Resources\MediaResource;
use App\Http\Resources\NoticeTypeResource;
use App\Http\Resources\Users\UserResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MapFullNoticeResource extends JsonResource
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
            'title' => $this->noticeType->name,
            'description' => $this->description,
            'lat' => $this->lat,
            'long' => $this->long,

            'date' => Carbon::parse($this->notice_date)
                ->locale('ar')
                ->translatedFormat('F Y') .
                ' – الساعة ' .
                Carbon::parse($this->notice_time)->format('h:i') . ' ' . // "10:45"
                (Carbon::parse($this->notice_time)->format('A') == 'AM' ? 'صباحًا' : 'مساءً'),

            'status' => (int)$this->status,
            'priority' => NoticeTypePriorityEnum::from($this->noticeType->priority)->lang(),
            'status_name' => NoticeStatusEnum::from($this->status)->lang(),
            "created_at" => Carbon::parse($this->created_at)->locale('ar')->translatedFormat('d F Y'),
            'user' => $this->user_id ? $this->user->full_name : $this->leader->full_name,
            'files' => MediaResource::collection($this->media),
            'user_image' => $this->user_id ? getFile($this->user->image) : getFile($this->leader->image)

        ];
    }
}
