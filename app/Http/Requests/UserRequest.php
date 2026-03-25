<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'full_name' => 'required|string',
            'national_id' => 'required|string|unique:users,national_id',
            'phone' => 'required|string|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed',


        ];
    }

    protected function update(): array
    {
        return [
            'full_name' => 'nullable|string',
            'national_id' => 'nullable|string|unique:users,national_id.' . $this->route('user'),
            'phone' => 'nullable|string|unique:users,phone .' . $this->route('user'),
            'email' => 'nullable|email|unique:users,email.' . $this->route('user'),
            'password' => 'nullable|string|confirmed',

        ];
    }
}
