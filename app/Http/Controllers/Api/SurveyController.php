<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SurveyResource;
use App\Models\Area;
use App\Services\Api\SurveyService;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function __construct(private SurveyService $surveyService) {}
    public function getSurveyByAreaId(Request $request)
    {
        if (!$request->area_id || $request->area_id == null) {
            return response()->json([
                'msg' => "المنطقة مطلوبة",
                'data' => [],
                'status' => 400
            ]);
        }
        $area_id = $request->area_id;
        return $this->surveyService->getSurveyByAreaId($area_id);
    }
}
