<?php

namespace App\Services\Api;

use App\Http\Resources\AreaResource;
use App\Models\Area;
use App\Services\BaseService;

class AreaService extends BaseService
{
    public function __construct(protected Area $area)
    {
        parent::__construct($area);
    }

    public function getAllAreas()
    {
        return $this->successResponse(AreaResource::collection(Area::main()->with('children')->get()));
    }
}
