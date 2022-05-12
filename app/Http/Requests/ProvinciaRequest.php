<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProvinciaRequest extends FormRequest
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
            'nome' => 'string|min:2|required|unique:provincias'
        ];
    }

    public function messages()
    {
        return [
            'nome.string' => 'Tipo de dados inválido',
            'nome.min' => 'Quantidade de carecteres inválida',
            'nome.required' => 'Campo nome inválida',
            'nome.unique' => 'Provincia já existente'
        ];
    }
}
