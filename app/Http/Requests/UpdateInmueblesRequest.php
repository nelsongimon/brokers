<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateInmueblesRequest extends Request
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
            'descripcion'       => 'required',
            'tipo_id'           => 'required',
            'area_construccion' => 'required',
            'negociacion_id'    => 'required',
            'estado_id'         => 'required',
            'ciudad_id'         => 'required',
            'sector_id'         => 'required',
            'asesor_id'         => 'required'
        ];
    }
}
