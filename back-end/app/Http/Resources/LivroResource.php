<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LivroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'cod' => $this->cod,
            'titulo' => $this->titulo,
            'editora' => $this->editora,
            'edicao' => $this->edicao,
            'valor' => 'R$ ' . number_format($this->valor / 100, 2, ',', '.'),
            'valor_puro' => $this->valor / 100,
            'ano_publicacao' => $this->ano_publicacao,
            'autores' => $this->authors,
            'assuntos' => $this->subjects,
        ];
    }
}
