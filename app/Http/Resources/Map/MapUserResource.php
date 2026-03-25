<?php

namespace App\Http\Resources\Map;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MapUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int)$this->id,
            'full_name' => $this->full_name,
            'national_id' => (int)$this->national_id,
            'phone' => $this->phone,
            'role' => $this->getRoleNames()->first(),
            'image' => getFile($this->image),
            'is_attendance_today' => $this->attendances->filter(function ($attendance) {
                return $attendance->checkin !== null &&
                    $attendance->checkout !== null &&
                    Carbon::parse($attendance->date)->format('Y-m-d') == Carbon::now()->format('Y-m-d');
            })->isNotEmpty(),
            'attendance_time' => $this->attendances->filter(function ($attendance) {
                return $attendance->checkin !== null && $attendance->checkout !== null && Carbon::parse($attendance->date)->format('Y-m-d') == Carbon::now()->format('Y-m-d');
            })->first()?->checkin ? Carbon::parse($this->attendances->first()->checkin)->format('H:i:s') : null,


        ];
    }
}
