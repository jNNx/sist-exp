<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'cuil' => 'required|integer|digits_between:11, 12',
            'password' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'cuil.digits_between' => 'CUIL debe tener entre 11/12 dígitos.',
            'cuil.required' => 'CUIL vacío. Debe completar su CUIL.',
            'cuil.integer' => 'Ingresó un CUIL con letras, vuelva a escribir un CUIL válido.',

            'password.required' => 'Contraseña vacía. Complete para poder ingresar.',
            'password.max' => 'Contraseña demasiado larga.',
        ];
    }
}
