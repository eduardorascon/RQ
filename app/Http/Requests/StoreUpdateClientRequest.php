<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateClientRequest extends FormRequest

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name'=> 'required',
            'last_name' => 'required',
            'address' => 'required',
            'company' => 'required',
            'phone' => 'required'];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'El nombre es necesario para el registro.',
            'last_name.required' => 'El apellido es necesario para el registro.',
            'address.required' => 'La dirección es necesaria para el registro.',
            'company.required' => 'El nombre de la compañia es necesaria para el registro.',
            'phone.required' => 'El teléfono es necesario para el registro.'
        ];
    }
}
