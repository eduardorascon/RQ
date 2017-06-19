<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLogPalpationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected $errorBag = 'log_palpation_errors';

    public function rules()
    {
        return [
            'date'=> 'required',
            'comment' => 'required',
            'months' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'date.required' => 'La fecha de palpación es necesario para el registro.',
            'comment.required' => 'Los comentarios son necesarios para el registro.',
            'months.required' => 'El numero de meses de gestación es necesario para el registro.'
        ];
    }
}
