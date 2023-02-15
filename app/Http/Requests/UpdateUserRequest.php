<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.request('id'),
            'salary' => 'required',
            'dob' => 'required',
            'image' => [
                'nullable',
            ],
        ];
    }
}
