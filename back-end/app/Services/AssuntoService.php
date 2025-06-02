<?php

namespace App\Services;

use App\Models\Assunto;
use App\Repositories\Contracts\AssuntoRepositoryInterface;

class AssuntoService
{
    public function __construct(private AssuntoRepositoryInterface $assuntoRepository) {}

    public function list(array $filters)
    {
        try {            
            $result =  $this->assuntoRepository->list($filters);

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
            return $this->assuntoRepository->show($assuntoId);
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
            $create =  $this->assuntoRepository->store([
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
        try {
            $update =  $this->assuntoRepository->update($assuntoId, [
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
            $deleted = $this->assuntoRepository->destroy($assuntoId);
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
