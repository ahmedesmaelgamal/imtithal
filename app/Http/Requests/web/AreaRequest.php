<?php

namespace App\Http\Requests\web;

use Illuminate\Foundation\Http\FormRequest;

class AreaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:areas,id',
            'location' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'status' => 'nullable|in:0,1',
            'leader_id' => 'nullable|exists:users,id',
            'team_ids' => 'nullable|array',
            'sub_leader_ids' => 'nullable|array',
        ];
    }
}
