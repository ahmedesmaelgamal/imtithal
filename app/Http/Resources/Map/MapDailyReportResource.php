<?php

namespace App\Http\Resources\Map;

use App\Models\Area;
use App\Models\QuestionAnswer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MapDailyReportResource extends JsonResource
{




    public function toArray(Request $request): array
    {
        $area=Area::where('axis_id', $this->axis_id)->first();
        return [
            'id' => (int)$this->id,
            'title'=>(string)$this->title,
            'axis_id'=>(int)$this->axis_id,
            'area_id'=>$area?(int)$area->id:null,

        ];
    }

}
