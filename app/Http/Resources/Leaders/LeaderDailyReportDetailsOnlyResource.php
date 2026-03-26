<?php

namespace App\Http\Resources\Leaders;

use App\Enum\LeaderDailyReportAssignUserStatusEnum;
use App\Enum\monitorType;
use App\Enum\SideType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaderDailyReportDetailsOnlyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'title' => $this->dailyReport->title,
            'description' => $this->dailyReport->description,
            'status' => (int)$this->status,
            'status_name' => LeaderDailyReportAssignUserStatusEnum::from($this->status)->lang(),
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y'),
            'monitor_type' => monitorType::from($this->dailyReport->monitor_type)->lang(),
            'side_type' => SideType::from($this->dailyReport->side_type)->lang(),
            'deadline' => $this->deadline,
            'daily_report_questions' => LeaderDailyReportQuestionAnswerResource::collection($this->answers)
        ];
    }
}
