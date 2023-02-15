<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBillRequest extends FormRequest
{

    public function rules()
    {
        return [
            'year'=>'required',
            'month'=>'required',
        ];
    }
}
