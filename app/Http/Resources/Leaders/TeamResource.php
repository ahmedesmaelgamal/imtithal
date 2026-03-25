<?php

namespace App\Http\Resources\Leaders;

use App\Enum\DailyReportAssignUserStatusEnum;
use App\Enum\UserRoleEnum;
use App\Http\Resources\Users\AreaResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       $role = User::find($this->id);
        return [
            'id' => (int)$this->id,
            'full_name' => $this->full_name,
            'national_id' => $this->national_id,
            'phone' => $this->phone,
            'email' => $this->email,
            'is_active' => (boolean) $this->is_active,
            'role' => $role->getRoleNames()->first(),
            'image' => getFile($this->image),
            'checkin' => $this->attendancesDay ? $this->attendancesDay->checkin : 'لم يتم التسجيل بعد',
            'checkout' => $this->attendancesDay ? $this->attendancesDay->checkout : 'لم يتم التسجيل بعد',
            'last_attendance' => $this->attendancesLastTwoDays ?? [],
        ];
    }
}
