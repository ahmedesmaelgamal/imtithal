<?php

namespace App\Http\Resources\Leaders;

use App\Enum\ReportStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaderReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'code' => (string)$this->code,
            'status' => (int)$this->status,
            'status_name' => ReportStatusEnum::from($this->status)->lang(),
            'body' => $this->body,
            'extra' => $this->extra,
            'files' => FileResource::collection($this->reportFiles)
        ];
    }
}
