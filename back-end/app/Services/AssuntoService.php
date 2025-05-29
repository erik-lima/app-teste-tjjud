<?php

namespace App\Services;

use App\Models\Assunto;
use Illuminate\Database\Eloquent\Model;

class AssuntoService {
    public function __construct(private Assunto $model) {}

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

    public function show(int $assuntoId)
    {
        try {
            return $this->model->find($assuntoId);
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
                'descricao' => $data['descricao'],
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

    public function update(int $assuntoId, array $data)
    {
        $value = $data['valor'] * 100;

        try {
            $update =  $this->model->update(['cod' => $assuntoId], [
                'descricao' => $data['descricao'],
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

    public function destroy(int $assuntoId)
    {
        try {
            $deleted = $this->model->destroy($assuntoId);
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