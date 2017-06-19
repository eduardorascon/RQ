<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCalfRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cow_id' => 'required',
            'cattle_birth_date' => 'required',
            'cattle_breed' => 'required',
            'cattle_owner' => 'required',
            'cattle_paddock' => 'required',
            'cattle_is_alive' => 'required',
            'cattle_gender' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'cow_id.required' => 'La madre del becerro es necesaria para el registro.',
            'cattle_birth_date.required' => 'La fecha de nacimiento es necesaria para el registro.',
            'cattle_breed.required' => 'La raza es necesaria para el registro.',
            'cattle_owner.required' => 'El dueño del becerro es necesario para el registro.',
            'cattle_paddock.required' => 'El potrero del becerro es necesario para el registro.',
            'cattle_is_alive.required' => 'El estatus ¿Esta vivo? es necesario para el registro.',
            'cattle_gender.required' => 'El sexo es necesario para el registro.'
        ];
    }
}
