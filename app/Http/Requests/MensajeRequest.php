<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class MensajeRequest extends FormRequest
{
    /**
     * Determine if the mensaje is authorized to make this request.
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
            'email' => 'required|email',
            'mensaje' => 'required',
        ];
        return $rules;
    }
}
