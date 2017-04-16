<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateLogWeightRequest extends FormRequest
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

    protected $errorBag = 'log_weight_errors';

    public function rules()
    {
        return [
            'weight'=> 'required',
            'date' => 'required',
            'comment' => 'required'];
    }

    public function messages()
    {
        return [
            'weight.required' => 'El peso es necesario para el registro.',
            'date.required' => 'La fecha de pesaje es necesaria para el registro.',
            'comment.required' => 'Los comentarios son necesarios para el registro.'
        ];
    }
}
