<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePictureRequest extends FormRequest
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

    protected $errorBag = 'save_picture_errors';

    public function rules()
    {
        return ['comment' => 'required'];
    }

    public function messages()
    {
        return ['comment.required' => 'Los comentarios son necesarios para el registro.'];
    }
}
