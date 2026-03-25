<?php

namespace App\Http\Requests\web;

use Illuminate\Foundation\Http\FormRequest;

class AccommodationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'nullable|string',
            'parent_id' => 'nullable|exists:accommodations,id',
            'location' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'status' => 'nullable|in:0,1',
        ];
    }
}
