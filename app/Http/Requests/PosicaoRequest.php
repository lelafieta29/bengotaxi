<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PosicaoRequest extends FormRequest
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
            'confirmacao_passageiro' => 'required',
            'confirmacao_motorista' => 'required',
            'solicitacao_id' => 'required',
            'viagem_id' => 'required',
        ];
    }
}
