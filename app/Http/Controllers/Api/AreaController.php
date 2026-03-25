<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\AreaService;

class AreaController extends Controller
{
    public function __construct(protected AreaService $objSerivce) {}

    public function getAllAreas()
    {
        return $this->objSerivce->getAllAreas();
    }
}
