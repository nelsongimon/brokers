<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreInmueblesRequest extends Request
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
            'titulo'            => 'required|min:3',
            'dolares'           => 'required|numeric',
            'descripcion'       => 'required',
            'nota'              => 'required',
            'area_parcela'      => 'required',
            'tipo_id'           => 'required',
            'area_construccion' => 'required',
            'negociacion_id'    => 'required',
            'cuartos'           => 'required|numeric',
            'banos'             => 'required|numeric',
            'estado_id'         => 'required',
            'ciudad_id'         => 'required',
            'estacionamientos'  => 'required|numeric',
            'sector_id'         => 'required',
            'asesor_id'         => 'required'
        ];
    }
}
