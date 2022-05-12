<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MunicipioRequest extends FormRequest
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
            'nome' => 'string',
            'provincia_id' => 'required|min:1'
        ];
    }
    public function messages()
    {
        return [
            'nome.string' => 'Tipo de dados inválido',
            'provincia_id.required' => 'Campo obrigatorio',
            'provincia_id.min' => 'Campo obrigatorio'
        ];
    }
}
