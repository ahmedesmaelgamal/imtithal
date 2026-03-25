<?php

namespace App\Http\Resources\Users;

use App\Enum\DailyReportAssignUserStatusEnum;
use App\Enum\LeaderDailyReportAssignUserStatusEnum;
use App\Enum\monitorType;
use App\Enum\SideType;
use App\Http\Resources\Leaders\LeaderAxisQuestionResource;
use App\Http\Resources\Users\AxisQuestionResource;
use App\Http\Resources\Users\AxisResource;
use App\Models\DailyReportAssignUser;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserDailyReportDetailsResource extends JsonResource
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

        $daily_report_assign_user=DailyReportAssignUser::where('daily_report_id',$this->id)->where('user_id',Auth::guard('user')->user()->id)->first();

//        dd($daily_report_assign_user->status);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => (int)$daily_report_assign_user->status,
            'status_name' => DailyReportAssignUserStatusEnum::from($daily_report_assign_user->status)->lang(),
            'created_at' => $this->created_at->format('d-m-Y'),
            'updated_at' => $this->updated_at->format('d-m-Y'),
            'monitor_type' => monitorType::from($this->monitor_type)->lang(),
            'side_type' => SideType::from($this->side_type)->lang(),
            'axis' => new AxisResource($this->axis),
//            'area' => new AreaResource($this->area),
            'deadline' => $this->deadline,
            'daily_report_questions' => UserAxisQuestionResource::collection($this->axis->axisQuestions)->map(function ($item) {
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
