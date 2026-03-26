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
        return [
            'id' => (int)$this->id,
            'title'=>(string)$this->title,
            'survey_id'=>$this->survey_id ? (int)$this->survey_id : null,

        ];
    }

}
