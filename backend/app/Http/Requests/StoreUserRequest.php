<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'dni'           => 'required|integer|digits_between:7, 8',
            'nombre'        => 'required|regex:/^[A-ZÁÀÂÇÉÈÊËÍÎÏÓÔÚÛÙÜŸÑÆŒa-záàâçéèêëíîïóôúûùüÿñæœ ]+$/|max:255',
            'apellido'      => 'required|regex:/^[A-ZÁÀÂÇÉÈÊËÍÎÏÓÔÚÛÙÜŸÑÆŒa-záàâçéèêëíîïóôúûùüÿñæœ ]+$/|max:255',
            'telefono'      => 'integer|digits_between:7, 15',
            'email'         => 'max:255|email',
            'direccion'     => 'max:50|string',
            'area_id'       => 'required',
            'tipo_user_id'  => 'required',
            'cuil'          => 'required|integer',
            'password'      => 'required|string|max:30',
        ];
    }

    public function messages()
    {
        return [
            'dni.required'              => 'Ingreso de DNI requerido.',
            'dni.integer'               => 'Solo puede ingresar números.',
            'dni.digits_between'        => 'Debe ingresar un numero de 7 u 8 dígitos.',
            'nombre.required'           => 'Ingrese nombre del nuevo iniciador.',
            'nombre.regex'              => 'Solo puede ingresar letras.',
            'nombre.max'                => 'Límite de caracteres alcanzado.',
            'apellido.regex'            => 'Solo puede ingresar letras.',
            'apellido.max'              => 'Límite de caracteres alcanzado.',
            'telefono.integer'          => 'Solo puede ingresar números.',
            'telefono.digits_between'   => 'Debe ingresar entre 7 y 15 números.',
            'email.email'               => 'Ingrese un mail válido.',
            'direccion.max'             => 'Máximo 50 caracteres.',
            'area_id.required'          => 'Seleccione un área.',
            'tipo_user_id.required'     => 'Seleccione tipo de usuario.',
            'cuil.integer'              => 'Solo puede ingresar números.',
            'cuil.digits_between'       => 'Debe ingresar un numero de 11 dígitos.',
            'password.required'         => 'Contraseña requerida.',
            'password.max'              => 'Contraseña demasiado larga.'
        ];
    }
}
