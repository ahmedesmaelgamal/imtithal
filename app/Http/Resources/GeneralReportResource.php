<?php

namespace App\Http\Resources;

use App\Enum\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GeneralReportResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'extra' => $this->extra,
            'media' => MediaResource::collection($this->media),



        ];
    }
}
