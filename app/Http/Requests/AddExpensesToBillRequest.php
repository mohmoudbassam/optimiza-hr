<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddExpensesToBillRequest extends FormRequest
{

    public function rules()
    {
      // dd($this->all());
        return [
            'expenses'=>[
                'required',
                'array',
                'min:1',

            ],
            'expenses.*.main_expenses_id'=>['required','exists:main_expenses,id'],
            'expenses.*.amount'=>['required'],
        ];
    }
}
