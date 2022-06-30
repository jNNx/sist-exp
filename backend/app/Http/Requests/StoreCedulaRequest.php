<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCedulaRequest extends FormRequest
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
            'descripcion'       => 'integer|unique:App\Models\Cedula,descripcion',
            'expediente_id'     => 'required',
            //'user_id'           => 'required'
        ];
    }

    public function messages()
    {
        return [
            'descripcion.integer'   => 'Solo puede ingresar números',
            'descripcion.unique'    => 'Número de cédula repetido',
            'expediente_id.required'=> 'Expediente requerido',
            //'user_id.required'      => 'Usuario requerido'
        ];
    }
}
