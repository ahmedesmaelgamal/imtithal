<?php

namespace App\Http\Resources\Leaders;

use App\Enum\LeaderDailyReportAssignUserStatusEnum;
use App\Enum\monitorType;
use App\Enum\SideType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaderDailyReportDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function __construct($resource, $user_id = null)
    {
        parent::__construct($resource);
        $this->user_id = $user_id;
    }
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => (int)$this->status,
            'status_name' => LeaderDailyReportAssignUserStatusEnum::from($this->status)->lang(),
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y'),
            'monitor_type' => monitorType::from($this->monitor_type)->lang(),
            'side_type' => SideType::from($this->side_type)->lang(),
            'deadline' => $this->deadline,
            'daily_report_questions' => LeaderAxisQuestionResource::collection($this->survey->surveyQuestions)->map(function ($item) {
                // Only assign user_id if it is not null
                if (!is_null($this->user_id)) {
                    $item->user_id = $this->user_id;
                }
                $item->daily_report_id = $this->id;
                return $item;
            }),
        ];
    }
}
