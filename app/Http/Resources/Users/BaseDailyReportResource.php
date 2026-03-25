<?php

namespace App\Http\Resources\Users;

use App\Enum\AnswerStatusEnum;
use App\Enum\DailyReportAssignUserStatusEnum;
use App\Enum\monitorType;
use App\Enum\SideType;
use App\Models\AxisQuestion;
use App\Models\DailyAssignUserAnswer;
use App\Models\DailyReportAssignUser;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseDailyReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $dailyReportAssignUser = DailyReportAssignUser::where('daily_report_id', $this->id)->first();

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => (int)$this->status,
            'status_name' => DailyReportAssignUserStatusEnum::from($this->status)->lang(),
            'monitor_type' => monitorType::from($this->monitor_type)->lang(),
            'side_type' => SideType::from($this->side_type)->lang(),
            'deadline' => (new \DateTime($this->deadline))->format('d-m-Y'),
            'axis' => new AxisResource($dailyReportAssignUser->axis),
            'area' => new AreaResource($this->area),
            'progress' => (int)$this->progress,
        ];
    }
}
