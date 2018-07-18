<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCalfRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cow_id' => 'required',
            'cattle_tag'=> 'required',
            'cattle_birth_date' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'cow_id.required' => 'La madre del becerro es necesaria para el registro.',
            'cattle_tag.unique' => 'El arete siniga ya fue utilizado en otro registro.',
            'cattle_birth_date.required' => 'La fecha de nacimiento es necesaria para el registro.'
        ];
    }
}
