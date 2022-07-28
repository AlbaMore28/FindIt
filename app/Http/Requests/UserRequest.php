<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'nombre' => 'required',
            'apellidos' => 'required',
            'nombre_usuario' => 'required|unique:users',
            'fecha_nac' => 'required',
            'telefono' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'imagen_perfil' => 'image'
        ];
        return $rules;
    }
}
