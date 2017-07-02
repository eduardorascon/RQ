<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreUpdateVaccineRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return ['name' => 'required'];
    }

    public function messages()
    {
        return ['name.required' => 'El nombre de la vacuna es necesario.'];
    }
}
