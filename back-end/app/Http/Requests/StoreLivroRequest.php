<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLivroRequest extends FormRequest
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
            'titulo' => 'required|string|max:40',
            'editora' => 'required|string|max:40',
            'edicao' => 'required|numeric|max:100|min:1',
            'ano_publicacao' => 'required|numeric|max:9999|min:1300',
            'valor' => 'required|numeric|max:10000000|min:1',
            'autores' => "required|array",
            'assuntos' => "required|array",
        ];
    }

    public function messages()
    {
        return [
            'titulo.required' => 'O título para o livro é obrigatório',
            'titulo.max' => 'Apenas 40 caracters para o título são permitidos',
            'editora.required' => 'O nome da editora é obrigatório',
            'editora.max' => 'Apenas 40 caracters são permitidos para o nome da editora',
            'edicao.required' => 'A edição do livro é obrigatória',
            'edicao.numeric' => 'A edição deve ser um número',
            'edicao.max' => 'Apenas edições entre 1 e 100 são permitidas',
            'ano_publicacao.required' => 'O ano de publicação é obrigatório',
            'ano_publicacao.numeric' => 'O ano de publicação deve ser um número',
            'ano_publicacao.max' => 'O ano de publicação deve ter 4 dígitos',
            'ano_publicacao.min' => 'O ano de publicação deve ter 4 dígitos',
            'valor.required' => 'O valor do livro é obrigatório',
            'valor.numeric' => 'O valor do livro deve ser um número',
            'valor.max' => 'O valor do livro não pode ser maior que 100.000',
            'valor.min' => 'O valor do livro deve ser pelo menos 0,01',
            'autores.array' => 'Os autores devem ser enviados em formato de lista',
            'assuntos.array' => 'Os assuntos devem ser enviados em formato de lista',
            'autores.required' => 'Os autores devem ser enviados',
            'assuntos.required' => 'Os assuntos devem ser enviados',
        ];
    }
}
