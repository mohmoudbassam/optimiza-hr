<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTeamRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name'=>'required',
            'manger_id'=>'required',
        ];
    }
}
