<?php

namespace App\Services;

use App\Models\Autor;
use App\Models\Livro;
use App\Repositories\Contracts\AutorRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class AutorService {
    public function __construct(private AutorRepositoryInterface $autorRepository) {}

    public function list(array $filters)
    {
        try {
            $result = $this->autorRepository->list($filters);
            return [
                'error' => false,
                'data' => $result
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'data' => "Houve um erro ao recuperar os dados"
            ];
        }
    }

    public function show(int $autorId)
    {
        try {
            return [
                'error' => false,
                'data' => $this->autorRepository->show($autorId)
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'data' => "Houve um erro ao recuperar os dados"
            ];
        }
    }

    public function store($data)
    {
        try {
            $create =  $this->autorRepository->store([
                'nome' => $data['nome'],
            ]);

            return [
                'error' => false,
                'data' => $create
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'data' => "Houve um erro ao salvar os dados"
            ];
        }
    }

    public function update(int $autorId, array $data)
    {
        try {
            $update =  $this->autorRepository->update($autorId, [
                'nome' => $data['nome'],
            ]);

            return [
                'error' => false,
                'data' => $update
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'data' => "Houve um erro ao atualizar os dados"
            ];
        }
    }

    public function destroy(int $autorId)
    {
        try {
            $deleted = $this->autorRepository->destroy($autorId);
            return [
                'error' => false,
                'data' => $deleted
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'data' => "Houve um erro ao remover os dados"
            ];
        }
    }

    public function booksByAuthor(int $cod) {
        return $this->autorRepository->booksByAuthor($cod);
    }
}