<?php

namespace App\Services;

use App\Models\Autor;
use App\Models\Livro;
use Illuminate\Database\Eloquent\Model;

class AutorService {
    public function __construct(private Autor $model) {}

    public function list()
    {
        try {
            $query = $this->model->query();
            $result =  $query->paginate();

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
            return $this->model->find($autorId);
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
            $create =  $this->model->create([
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
        $value = $data['valor'] * 100;

        try {
            $update =  $this->model->update(['cod' => $autorId], [
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
            $deleted = $this->model->destroy($autorId);
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
}