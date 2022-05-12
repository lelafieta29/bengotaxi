<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SolicitacaoRequest extends FormRequest
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
            'endereco_origem_id' => 'required|integer',
            'endereco_destino_id' => 'required|integer',
            'hora' => 'required',            
        ];
    }

    public function messages()
    {
        return [
            'endereco_origem_id.required' => 'Endereço Origem obrigatório',
            'endereco_destino_id.required' => 'Endereço Destino obrigatório',
            'hora' => 'Hora obrigatório',            
        ];
    }
}
