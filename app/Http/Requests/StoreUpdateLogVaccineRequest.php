<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateLogVaccineRequest extends FormRequest
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

    protected $errorBag = 'log_vaccine_errors';

    public function rules()
    {
        return [
            'vaccine' => 'required',
            'date'=> 'required',
            'comment' => 'required'];
    }

    public function messages()
    {
        return [
            'vaccine.required' => 'La vacuna aplicada es necesaria para el registro.',
            'date.required' => 'La fecha de vacunacion es necesaria para el registro.',
            'comment.required' => 'Los comentarios son necesarios para el registro.'
        ];
    }
}
