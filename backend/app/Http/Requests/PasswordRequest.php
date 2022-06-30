<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'password'  => 'required|string|min:8|max:15'];
    }

    public function messages()
    {
        return [
            'password.required'         => 'Debe ingresar la contraseña',
            'password.min'   => 'Debe ingresar más de 8 caracteres',
            'password.max'   => 'Debe ingresar menos de 15 caracteres'
        ];
    }
}
