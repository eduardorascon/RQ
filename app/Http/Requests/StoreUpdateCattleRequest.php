<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCattleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cattle_tag'=> 'required',
            'cattle_birth_date' => 'required',
            'cattle_purchase_date' => 'required',
            'cattle_breed' => 'required',
            'cattle_owner' => 'required',
            'cattle_is_alive' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'cattle_tag.required' => 'El arete siniga es necesario para el registro.',
            'cattle_birth_date.required' => 'La fecha de nacimiento es necesaria para el registro.',
            'cattle_purchase_date.required' => 'La fecha de compra es necesaria para el registro.',
            'cattle_breed.required' => 'La raza es necesaria para el registro.',
            'cattle_owner.required' => 'El dueño del becerro es necesario para el registro.',
            'cattle_is_alive.required' => 'El estatus ¿Esta vivo? es necesario para el registro.'
        ];
    }
}
