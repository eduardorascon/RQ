<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCowRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cattle_tag'=> 'required',
            'cattle_birth_date' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'cattle_tag.required' => 'El arete siniga es necesario para el registro.',
            'cattle_birth_date.required' => 'La fecha de nacimiento es necesaria para el registro.'
        ];
    }
}
