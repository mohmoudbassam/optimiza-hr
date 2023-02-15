<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{

    public function rules()
    {

        return [
            'name'=>'required',
            'email'=>'required|email',
            'salary'=>'required',
            'dob'=>[
                 'nullable',
                'date',
                'before:today'
            ],
            'image'=>'required'

        ];
    }
}
