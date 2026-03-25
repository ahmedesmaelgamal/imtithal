<?php

namespace App\Http\Resources\Map;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusTimeResource extends JsonResource
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
            'area'=>$this->area->name,
            'user'=>$this->user->full_name,
            'image'=>getFile($this->user->image),
            'bus_count'=>$this->bus_count,
            'end_time' => $this->end_time
                ? Carbon::parse($this->end_time)
                    ->locale('ar')
                    ->translatedFormat('l d F Y، h:i A')
                : null,

        ];
    }

}
