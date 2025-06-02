<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssuntoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'descricao' => 'required|string|max:40',
        ];
    }

    public function messages()
    {
        return [
            'descricao.required' => "A descrição para o assunto é obrigatório",
            'descricao.max' => "Apenas 40 caracteres são permitidos para a descrição",
        ];
    }
}
