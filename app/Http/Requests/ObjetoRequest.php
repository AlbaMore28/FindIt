<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ObjetoRequest extends FormRequest
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
            'titulo' => 'required',
            'color' => 'required',
            'lugar' => 'required',
            'descripcion' => 'required',
            'tamanio' => 'required|in:grande,mediano,pequenio',
            'categoria' => 'required',
            'latitud' => 'required',
            'longitud' => 'required'
            /* 'imagenes' => 'image' */
        ];
        return $rules;
    }
}
