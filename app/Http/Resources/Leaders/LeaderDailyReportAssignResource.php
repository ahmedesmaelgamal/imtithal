<?php

namespace App\Http\Resources\Leaders;

use App\Enum\DailyReportAssignUserStatusEnum;
use App\Enum\LeaderDailyReportAssignUserStatusEnum;
use App\Http\Resources\Users\AreaResource;
use App\Http\Resources\Users\AxisResource;
use App\Models\AxisQuestion;
use App\Models\DailyReportAssignUser;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaderDailyReportAssignResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->dailyReport->id,
            'daily_report_assign_id' => $this->id,
            'title' => $this->dailyReport->title,
            'description' => $this->dailyReport->description,
            'status' => (int)$this->status,
            'status_name' => LeaderDailyReportAssignUserStatusEnum::from($this->status)->lang(),
            'monitor_type' => $this->dailyReport->monitor_type,
            'side_type' => $this->dailyReport->side_type,
            'axis' => new AxisResource($this->axis),
            'area' => new AreaResource($this->area),
            'deadline' => $this->deadline,
            'user_id' => (int) $this->user->id,
            'user_name' => $this->user->full_name,
            'user_image'=> getFile($this->user->image),
            'created_at' => $this->created_at->format('Y-m-d'),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
    }
}
