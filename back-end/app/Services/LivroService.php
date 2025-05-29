<?php

namespace App\Services;

use App\Models\Livro;
use Illuminate\Database\Eloquent\Model;

class LivroService
{

    public function __construct(private Livro $model) {}

    public function list()
    {
        try {
            $query = $this->model->query();
            $result =  $query->get();

            return [
                'error' => false,
                'data' => $result
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
            return $this->model->find($livroId);
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
            $create =  $this->model->create([
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
                $this->model->find($create->cod)->authors()->sync($ids);
            }
            if ($data['assuntos']) {
                $ids = array_map(function ($item) {
                    return $item['cod'];
                }, $data['assuntos']);
                $this->model->find($create->cod)->subjects()->sync($ids);
            }

            return [
                'error' => false,
                'data' => $create
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'data' => $e->getMessage()
                // 'data' => "Houve um erro ao salvar os dados"
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
