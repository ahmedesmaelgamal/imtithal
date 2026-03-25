<?php

namespace App\Http\Resources\Users;

use App\Enum\AreaTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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
            'area_id' => (int)$this->area_id,
            'north' => $this->north,
            'south' => $this->south,
            'east' => $this->east,
            'west' => $this->west,
        ];
    }
}
