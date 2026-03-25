<?php

namespace App\Http\Resources\Users;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>(int) $this->id,
            'checkin'=>   Carbon::parse($this->checkin)->addHours(3)->format('Y-m-d H:i:s.u'),
            'checkout'=> $this->checkout?  Carbon::parse($this->checkout)->addHours(3)->format('Y-m-d H:i:s.u'):null,

            'checkin_lat'=> $this->checkin_lat,
            'checkin_long'=> $this->checkin_long,
            'checkout_lat'=> $this->checkout_lat,
            'checkout_long'=> $this->checkout_long,
            'user_id'=> $this->user_id,
            'user'=> $this->user->full_name,
            'data'=> $this->data,
            'month'=>Carbon::parse($this->created_at)->format('F'),


        ];
    }
}
