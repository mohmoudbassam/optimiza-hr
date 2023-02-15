<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:companies,email,'.request('id'),
            'website' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ];
    }
}
