<?php

namespace App\Http\Requests\web;

use Illuminate\Foundation\Http\FormRequest;

class TripRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'trip_number' => 'required|string|max:255|unique:trips,trip_number,' . $this->route('trip'),
            'air_carrier' => 'required|string|max:255',
            'departure_country' => 'required|string|max:255',
            'readiness_list_number' => 'nullable|string|max:255',
            'service_provider' => 'nullable|string|max:255',
            'hajj_groups_count' => 'nullable|integer|min:0',
            'hajjis_count' => 'nullable|integer|min:0',
            'area_id' => 'nullable|exists:areas,id',
            'contract_number' => 'nullable|string|max:255',
            'arrival_date' => 'nullable|date',
            'arrival_time' => 'nullable',
            'executor' => 'nullable|string|max:255',
            'residence_city' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'trip_number.required' => 'رقم الرحلة مطلوب',
            'trip_number.unique' => 'رقم الرحلة مسجل مسبقاً',
            'air_carrier.required' => 'الناقل الجوي مطلوب',
            'departure_country.required' => 'بلد المغادرة مطلوب',
        ];
    }
}
