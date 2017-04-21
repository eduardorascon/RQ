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
            'cattle_gender' => 'required',
            'cow_fertility' => 'required',
            'cow_pregnancy_status' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'cattle_tag.required' => 'El valor del arete siniga es necesario para el registro.',
            'cattle_birth_date.required' => 'La fecha de nacimiento es necesaria para el registro.',
            'cattle_purchase_date.required' => 'La fecha de compra es necesaria para el registro.',
            'cattle_breed.required' => 'La raza es necesaria para el registro.',
            'cattle_gender.required' => 'El sexo es necesario para el registro.',
            'cow_fertility.required' => 'La fertilidad es necesaria para el registro.'
            'cow_pregnancy_status.required' => 'El estatus de preñes es necesario para el registro.'
        ];
    }
}
