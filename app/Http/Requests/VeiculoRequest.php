<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VeiculoRequest extends FormRequest
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
            'nome' => 'required|string',
            'placa' => 'required|string|unique:veiculos',
            'ano' => 'required|integer',
            'descricao' => 'required|string',
            'cor' => 'required|string',
            'capacidade' => 'required|integer',
            'ultima_revisao' => 'required',
            'empresa_transportes_id' => 'required|integer',
        ];
    }
}
