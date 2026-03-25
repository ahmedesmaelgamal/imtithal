<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if ($this->isMethod('put')) {
            return $this->update();
        } else {
            return $this->store();
        }
    }

    protected function store(): array
    {
        return [
            'checkin_date' => 'required|date_format:H:i',
            'checkout_date' => 'required|date_format:H:i',
            'checkin_max_date' => 'required|after:checkin_date|date_format:H:i',
            'checkout_max_date' => 'required|after:checkout_date|date_format:H:i',


        ];
    }

    public function messages()


    {

        return [
            'checkin_date.required' => 'تاريخ تسجيل الوصول مطلوب',
            'checkout_date.required' => 'تاريخ تسجيل المغادرة مطلوب',
            'checkin_max_date.required' => 'تاريخ تسجيل الوصول الأقصى مطلوب',
            'checkin_max_date.after' => 'يجب أن يكون تاريخ تسجيل الوصول الأقصى بعد تاريخ تسجيل الوصول',
            'checkout_max_date.required' => 'تاريخ تسجيل المغادرة الأقصى مطلوب',
            'checkout_max_date.after' => 'يجب أن يكون تاريخ تسجيل المغادرة الأقصى بعد تاريخ تسجيل المغادرة',
            'checkin_date.date_format' => 'يجب أن يكون تاريخ تسجيل الوصول بتنسيق H:i',
            'checkout_date.date_format' => 'يجب أن يكون تاريخ تسجيل المغادرة بتنسيق H:i',
            'checkin_max_date.date_format' => 'يجب أن يكون تاريخ تسجيل الوصول الأقصى بتنسيق H:i',
            'checkout_max_date.date_format' => 'يجب أن يكون تاريخ تسجيل المغادرة الأقصى بتنسيق H:i',

        ];

}
}
