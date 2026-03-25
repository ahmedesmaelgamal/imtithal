<?php

namespace App\Http\Resources\Map;

use App\Enum\AreaTypeEnum;
use App\Http\Resources\Users\LocationResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MapAreaResource extends JsonResource
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
            'name' => $this->name,
            'axis_id' => $this->axis_id,
            'type' => AreaTypeEnum::from($this->type)->lang(),

            'location' => new LocationResource($this->location),


        ];
    }
}
