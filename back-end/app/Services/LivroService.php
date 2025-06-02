<?php

namespace App\Services;

use App\Models\Livro;
use App\Repositories\Contracts\LivroRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class LivroService
{

    public function __construct(
        private LivroRepositoryInterface $livroRepository
    ) {}

    public function list(array $filters)
    {
        try {
            $data = $this->livroRepository->list($filters);
            return [
                'error' => false,
                'data' => $data
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'data' => $e->getMessage()
            ];
        }
    }

    public function show(int $livroId)
    {
        try {
            return $this->livroRepository->show($livroId);
        } catch (\Exception $e) {
            return [
                'error' => true,
                'data' => "Houve um erro ao recuperar os dados"
            ];
        }
    }

    public function store($data)
    {
        $value = $data['valor'] * 100;

        try {
            $create =  $this->livroRepository->store([
                'titulo' => $data['titulo'],
                'editora' => $data['editora'],
                'edicao' => $data['edicao'],
                'valor' => $value,
                'ano_publicacao' => $data['ano_publicacao'],
            ]);

            if ($data['autores']) {
                $ids = array_map(function ($item) {
                    return $item['cod'];
                }, $data['autores']);
                $this->livroRepository->show($create->cod)->authors()->sync($ids);
            }
            if ($data['assuntos']) {
                $ids = array_map(function ($item) {
                    return $item['cod'];
                }, $data['assuntos']);
                $this->livroRepository->show($create->cod)->subjects()->sync($ids);
            }

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

    public function update(int $livroId, array $data)
    {
        $value = $data['valor'] * 100;

        try {
            $update = $this->model->find($livroId)->update([
                'titulo' => $data['titulo'],
                'editora' => $data['editora'],
                'edicao' => $data['edicao'],
                'valor' => $value,
                'ano_publicacao' => $data['ano_publicacao'],
            ]);

            if ($data['autores']) {
                $ids = array_map(function ($item) {
                    return $item['cod'];
                }, $data['autores']);
                $this->model->find($livroId)->authors()->sync($ids);
            }
            if ($data['assuntos']) {
                $ids = array_map(function ($item) {
                    return $item['cod'];
                }, $data['assuntos']);
                $this->model->find($livroId)->subjects()->sync($ids);
            }

            return [
                'error' => false,
                'data' => $update
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                // 'data' => "Houve um erro ao atualizar os dados"
                'data' => $e->getMessage()
            ];
        }
    }

    public function destroy(int $livroId)
    {
        try {
            $deleted = $this->model->destroy($livroId);
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
