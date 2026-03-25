<?php

namespace App\Services\Api;

use App\Http\Resources\SurveyResource;
use App\Models\Area;
use App\Models\Survey;
use App\Services\BaseService;

class SurveyService extends BaseService
{
    public function __construct(protected Area $area, protected Survey $survey)
    {
        parent::__construct($area);
    }

    public function getSurveyByAreaId($areaId)
    {
        $area = $this->area->with(['surveys'])->find($areaId);

        if (!$area || $area->surveys->isEmpty()) {
            return $this->responseMsg('لا يوجد استبيانات مرتبطة بهذه المنطقة', null, 404);
        }

        return $this->successResponse($area->surveys->select(["id" , "title"]));
    }
}
