<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreSectoresRequest extends Request
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
            'sector'    => 'required|unique:sectores',
            'ciudad_id' => 'required',
            'estado_id' => 'required'
        ];
    }
}
