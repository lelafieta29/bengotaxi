<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MotoristaRequest extends FormRequest
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

    public function rules()
    {
        return [
            'nome' => 'required|string|min:2',
            'bi' => 'required|string|size:14',
            'carta_conducao' => 'required|string|min:2',
            'email' => 'required|string|unique:users,email',
            'telefone' => 'required|integer|unique:users,telefone',
            'distrito_id' => 'required',
            'password' => 'required|min:8',
            'nascimento' => 'required|date',
            'empresa_transportes_id' => 'required|integer',
        ];
    }
}
