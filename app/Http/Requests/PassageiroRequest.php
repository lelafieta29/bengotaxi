<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PassageiroRequest extends FormRequest
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
            'telefone' => 'required|string|min:9',
            'user_id' => 'required|integer',
        ];
    }
}
