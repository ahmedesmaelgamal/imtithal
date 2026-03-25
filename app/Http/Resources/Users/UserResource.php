<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'role' => $this->getRoleNames()->first(),
            'image' => getFile($this->image),
            'fcm_token' => $this->fcm_token,
            'is_active' => (boolean) $this->is_active,
            'notification_count' => $this->getRoleNames()->first()=='مشرف'?
                $this->leaderalerts()->where('seen', '0')->count()
                :$this->alerts()->where('seen', '0')->count(),

            'jwt_token' => $this->jwt_token,
        ];
    }
}
