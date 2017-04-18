<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateBreedRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
        return [
            'name.required' => 'El nombre de la raza es necesario.'
        ];
    }
}
