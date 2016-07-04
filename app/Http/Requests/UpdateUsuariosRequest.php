<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateUsuariosRequest extends Request
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
            'nombre' => 'required|Alpha|min:2',
            'apellido' => 'required|Alpha|min:2',
            'email' => 'required|E-Mail|unique:users',
            'perfil' => 'required'
        ];
    }
}
