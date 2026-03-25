<?php

namespace App\Http\Resources\Leaders;

use App\Enum\GlobalStatusEnum;
use App\Enum\UserRoleEnum;
use App\Http\Resources\Users\AreaResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaderResource extends JsonResource
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
            'national_id' => $this->national_id,
            'phone' => $this->phone,
            'email' => $this->email,
            'is_active' => (boolean) $this->is_active,
            'role' => $this->getRoleNames()->first(), // Get the first role (or use array for multiple)
            'image' => getFile($this->image),
            'fcm_token' => $this->fcm_token,
            'jwt_token' => $this->jwt_token,
        ];
    }
}
