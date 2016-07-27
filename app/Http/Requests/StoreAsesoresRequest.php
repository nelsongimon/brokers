<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreAsesoresRequest extends Request
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
            'nombre'   => 'required|min:2|max:50|Alpha',
            'apellido' => 'required|min:2|max:50|Alpha',
            'telefono' => 'required|min:11',
            'email'    => 'required|E-Mail',
            'foto'     => 'required|Image'
        ];
    }
}
