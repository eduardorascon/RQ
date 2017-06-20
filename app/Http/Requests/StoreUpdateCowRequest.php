<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCowRequest extends FormRequest
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
            'cattle_paddock' => 'required',
            'cow_fertility' => 'required',
            'cow_pregnancy_status' => 'required',
            'cattle_is_alive' => 'required',
            'cow_number_of_calves' => 'required'
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
            'cattle_paddock.required' => 'El potrero del becerro es necesario para el registro.',
            'cow_fertility.required' => 'La fertilidad de la vaca es necesaria para el registro.',
            'cow_pregnancy_status.required' => 'El estatus de gestación es necesario para el registro.',
            'cattle_is_alive.required' => 'El estatus ¿Esta vivo? es necesario para el registro.',
            'cow_number_of_calves.required' => 'El numero de becerros es necesario para el registro.'
        ];
    }
}
