<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequestByTeamMember extends FormRequest
{

    public function rules()
    {
        return [

            'tasks'=>[
                'required',
                'array',
                'min:1',

            ],
            'tasks.*.hours'=>['required'],
            'tasks.*.project_id'=>['required'],
        ];
    }
}
