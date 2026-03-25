<?php

namespace App\Http\Resources\Leaders;

use App\Enum\GlobalStatusEnum;
use App\Enum\UserRoleEnum;
use App\Http\Resources\Users\AreaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyReportResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'monitor_type' => $this->monitor_type,
            'side_type' => $this->side_type,
        ];
    }
}
