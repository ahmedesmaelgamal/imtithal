<?php

namespace App\Http\Resources\Map;

use App\Enum\DailyReportAssignUserStatusEnum;
use App\Http\Resources\Users\UserResource;
use App\Models\Area;
use App\Models\QuestionAnswer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MapDailyReportDetailsResource extends JsonResource
{




    public function toArray(Request $request): array
    {
        $area=Area::where('axis_id', $this->axis_id)->first();
        return [
            'id' => $this->daily_report_id,
            'user_name' => $this->user->full_name,
            'user_image'=> getFile($this->user->image),
            'leader_name' => $this->leader->full_name,
            'leader_image'=> getFile($this->leader->image),

            'title'=>(string)$this->dailyReport->title,
            'date' => Carbon::parse($this->created_at)->locale('ar')->translatedFormat('d F Y'),
            'status' => (int)$this->status,
            'status_name' => DailyReportAssignUserStatusEnum::from($this->status)->lang(),

        ];
    }

}
