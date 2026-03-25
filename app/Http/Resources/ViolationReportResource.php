<?php

namespace App\Http\Resources;

use App\Enum\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ViolationReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' =>(int) $this->id,
            'reference_number'=>(int)$this->reference_number,
//            'violation_time' => $this->violation_time ? $this->violation_time->format('h:i A') : null,
            'violation_time' => \Carbon\Carbon::parse($this->violation_time)->translatedFormat('h:i A'),
            'created_at' => $this->created_at->translatedFormat('d-m-Y'),
            'map_url'=>$this->map_url,
            'lat'=>$this->lat,
            'long'=>$this->long,
            'plate_number'=>$this->plate_number,
            'plate_letter_ar'=>$this->plate_letter_ar,
            'plate_letter_en'=>$this->plate_letter_en,
            'vehicle_type' =>  VehicleType::from($this->vehicle_type)?->lang() ?? null,

            'title' => $this->title,
            'description' => $this->description,
            'plate_image'=>$this->violation_image?getFile($this->plate_image):null,
            'plate_image_size' => getFileSizeInMB($this->plate_image),
            'violation_image'=>$this->violation_image?getFile($this->violation_image):null,
            'violation_image_size' => getFileSizeInMB($this->violation_image),

            'violation_video'=>$this->violation_video?getFile($this->violation_video):null,
            'violation_video_size' => getFileSizeInMB($this->violation_video),


        ];
    }
}
