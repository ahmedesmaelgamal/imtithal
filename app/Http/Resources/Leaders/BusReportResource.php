<?php

namespace App\Http\Resources\Leaders;

use App\Http\Resources\MediaResource;
use App\Http\Resources\Users\AreaResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BusReportResource extends JsonResource
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
            'area' => AreaResource::make($this->area),
            'bus_count' => (int)$this->bus_count,
            'end_time' => Carbon::parse($this->end_time)->translatedFormat('d-m-Y H:i:s'),
        ];


    }
}
