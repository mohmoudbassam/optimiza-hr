<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddBillToUserRequest extends FormRequest
{

    public function rules()
    {
        return [
            'user_id' => ['required', 'exists:users,id'],

            'tasks'=>[
                'required',
                'array',
                'min:1',

            ],
            'tasks.*.percentage'=>['required'],

        ];
    }
}
