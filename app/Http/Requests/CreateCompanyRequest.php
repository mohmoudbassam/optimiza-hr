<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name'=>'required',
            'email'=>'required|email',
            'website'=>'nullable|url',
            'image'=>'required|image'
        ];
    }
}
