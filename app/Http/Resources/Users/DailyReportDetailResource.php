<?php

namespace App\Http\Resources\Users;

use App\Http\Resources\Leaders\LeaderResource;
use App\Models\Axis;
use App\Models\DailyAssignUserAnswer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyReportDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $dailyReportQuestions = Axis::where('id', $this->axis_id)->first();
        $dailyReportAnswers = DailyAssignUserAnswer::where('daily_report_assign_user_id', $this->id)->get();

        return [
            "id" => $this->id,
            "main_daily_report" => DailyReportResource::make($this->dailReport),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "leader" => LeaderResource::make($this->leader),
            "user" => UserResource::make($this->user),

        ];
    }
}
