<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIniciadorRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'telefono'          => 'integer|digits_between:7, 15|nullable',
            'email'             => 'max:30|email|nullable',
            'direccion'         => 'max:50|string|nullable',
        ];
    }

    public function messages()
    {
        return [
            'telefono.integer'          => 'Solo puede ingresar números',
            'telefono.digits_between'   => 'Debe ingresar entre 7 y 15 números',
            'email.email'               => 'Ingrese un email válido',
            'email.max'                 => 'Email demasiado largo',
            'direccion.max'             => 'Máximo 50 caracteres'
        ];
    }
}
