<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ViagemRequest extends FormRequest
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

            'endereco_origem_id' => 'required',
            'endereco_destino_id' => 'required',
            'tipo_viagem' => 'required|string',
            'situacao' => 'required|string',
            'origem' => 'required|string',
            'destino' => 'required|string',
            'hora_inicio' => 'required',
            'valor' => 'required',
            'status' => 'required',
            'veiculo_id' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'endereco_origem_id.required' => 'Endereço origem obrigatório',
            'endereco_destino_id.required' => 'Endereço destino obrigatório',
            'valor.required' => 'Valor obrigatório',
            'valor.integer' => 'Valor tem de ser inteiro',
            'veiculo_id.required' => 'Veículo origem obrigatório',
        ];
    }
}
