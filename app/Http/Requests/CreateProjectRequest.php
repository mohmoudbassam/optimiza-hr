<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name'=>'required',
            'company_id'=>'required',

        ];
    }
}
