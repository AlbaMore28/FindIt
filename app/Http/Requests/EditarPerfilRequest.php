<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditarPerfilRequest extends FormRequest
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
        $usuario = User::find(Auth::user()->id);

        return [
            'nombre' => 'required',
            'apellidos' => 'required',
            'nombre_usuario' => 'required|unique:users,nombre_usuario,' . $usuario->id,
            'fecha_nac' => 'required|date|olderThan',
            'telefono' => 'numeric|nullable',
            'imagen_perfil' => 'image'
        ];
    }
}
