<?php

namespace App\Http\Resources\Leaders;

use App\Enum\DailyReportAssignUserStatusEnum;
use App\Enum\UserRoleEnum;
use App\Http\Resources\Users\AreaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamByAreaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>(int) $this->user->id,
            'full_name'=> $this->user->full_name,
            'role' => $this->user->getRoleNames()->first(), // Get the first role (or use array for multiple)
            'image'=> getFile($this->user->image),
            'is_active'=> $this->user->is_active,
        ];
    }
}
