<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreUsuariosRequest extends Request
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
            'nombre' => 'required|min:2|max:50',
            'apellido' => 'required|min:2|max:50',
            'email'    => 'required|E-Mail',
            'password' => 'required|min:6',
            'perfil' => 'required'
        ];
    }
}
