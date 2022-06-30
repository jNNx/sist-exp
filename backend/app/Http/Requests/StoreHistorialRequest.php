<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHistorialRequest extends FormRequest
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
            'area_destino_id'   => 'required',
            'observacion'            => 'required|max:255',
            'fojas'             => 'required|max:1000|integer'
        ];
    }

    public function messages()
    {
        return [
            'area_destino_id.required'      => 'Debe indicar un area destino.',
            'observacion.required'               => 'Campo requerido.',
            'observacion.max'                    => 'Máximo 255 caracteres.',
            'fojas.required'                => 'Debe ingresar cantidad de fojas.',
            'fojas.max'                     => 'Máximo 1000 fojas.',
            'fojas.integer'                 => 'Debe ingresar números.'
        ];
    }
}
