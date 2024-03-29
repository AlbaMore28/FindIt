<?php

namespace App\Http\Requests;

use Carbon\Carbon;
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
            'fecha_nac' => 'required|date|olderThan',
            'telefono' => 'numeric',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'imagen_perfil' => 'image'
        ];
        return $rules;
    }
}
