<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
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
            'file' => getFile($this->file),
            'file_type' => $this->file_type,
            'file_name' => $this->file_name,
            'file_size' => getFileSizeInMB($this->file),
        ];
    }
}
