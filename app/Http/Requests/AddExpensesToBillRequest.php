<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddExpensesToBillRequest extends FormRequest
{

    public function rules()
    {
        return [

            'expenses'=>[
                'required',
                'array',
                'min:1',
            ],
            'expenses.*.amount'=>['required'],
            'expenses.*.description'=>['required'],

        ];
    }
}
