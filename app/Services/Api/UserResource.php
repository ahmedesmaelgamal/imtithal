<?php

namespace App\Services\Api;

use App\Http\Resources\AreaResource;
use App\Http\Resources\Leaders\TeamResource;
use App\Models\Area;
use App\Models\User;
use App\Services\BaseService;

class UserResource extends BaseService
{
    public function __construct(protected User $user) {}

    public function getAllEmployees()
    {
        return $this->successResponse(TeamResource::collection($this->user->role('مراقب', 'user')->get()));
    }
}
