<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpedienteRequest extends FormRequest
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
            'nro_fojas'             => 'required|max:1000|integer',
            'prioridad_id'          => 'required',
            //'monto'     => 'required|integer',
            'descripcion_extracto'  => 'required',
            'iniciador_id'          => 'required',
            'archivos'              => 'mimes:docx|txt|pdf|jpg|jpeg|xlsx|xls|file|size:25600',
            'area_id'               => 'required',
            'observacion'           => 'max:150'
        ];
    }

    public function messages()
    {
        return [
            'nro_fojas.required'    => 'Ingrese cantidad de fojas.',
            'nro_fojas.max'         => 'Número máximo excedido.',
            'nro_fojas.integer'     => 'Solo puede ingresar números.',
            'prioridad_id.required'    => 'Seleccione prioridad del expediente.',
            // 'monto.required'        => 'Ingrese un monto',
            // 'monto.integer'         => 'Solo puede ingresar números',
            'descripcion_extracto.required' => 'Descripción del extracto requerida.',
            'iniciador_id.required' => 'Seleccione un iniciador.',
            'archivos.mimes'        => 'Seleccione un archivo con la extensión correcta.',
            'archivos.size'         => 'El archivo es demasiado pesado.',
            'area_id.required'      => 'Seleccione un área.',
            'observacion.max'           => 'La observación no debe ser superior a 150 caracteres.'
        ];
    }
}
