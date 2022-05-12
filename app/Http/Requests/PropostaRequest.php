<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropostaRequest extends FormRequest
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
            'confirmacao_passageiro' => 'required|integer',
            'confirmacao_motorista' => 'required|integer',
            'solicitacao_id' => 'required|integer',
            'viagem_id' => 'required|integer',
        ];
    }
}
