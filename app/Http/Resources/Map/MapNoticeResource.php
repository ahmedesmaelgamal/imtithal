<?php

namespace App\Http\Resources\Map;

use App\Enum\DailyReportRejectReasonEnum;
use App\Enum\NoticeStatusEnum;
use App\Http\Resources\MediaResource;
use App\Http\Resources\NoticeTypeResource;
use App\Http\Resources\Users\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MapNoticeResource extends JsonResource
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
            'title' => $this->name,
//'area_id' => optional($this->user)?->areas?->first()?->area?->id,
//'axis_id' => optional($this->user)?->areas?->first()?->area?->axis_id

        ];
    }
}
