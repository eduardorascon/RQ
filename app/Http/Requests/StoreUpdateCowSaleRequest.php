<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCowSaleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'sale_date'=> 'required',
            'sale_weight' => 'required',
            'price_per_kilo' => 'required',
            'client_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'sale_date.required' => 'La fecha de venta es necesaria para el registro.',
            'sale_weight.required' => 'El peso de venta es necesaria para el registro.',
            'price_per_kilo.required' => 'El precio por kilo es necesaria para el registro.',
            'client_id.required' => 'El cliente es necesario para el registro.'
        ];
    }
}
