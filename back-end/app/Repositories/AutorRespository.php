<?php

namespace App\Repositories;

use App\Models\Autor;
use App\Repositories\Contracts\AutorRepositoryInterface;
use Exception;
use PDOException;

class AutorRespository implements AutorRepositoryInterface
{
    public function __construct(private Autor $autor) {}

    public function list(array $filters)
    {
        return $this->autor
            ->when(isset($filters['term']), function ($q) use ($filters) {
                $q->where('nome', 'like', '%' . $filters['term'] . '%');
            })
            ->paginate();
    }

    public function count(?array $filters)
    {
        return $this->autor
            ->when(isset($filters['term']), function ($q) use ($filters) {
                $q->where('descricao', 'like', '%' . $filters['term'] . '%');
            })
            ->count();
    }

    public function show(int $cod)
    {
        return $this->autor->find($cod);
    }

    public function store(array $data)
    {
        return $this->autor->create($data);
    }

    public function update(int $cod, array $data)
    {
        $item = $this->autor->find($cod);
        return $item->update($data);
    }

    public function destroy(int $cod)
    {
        return $this->autor->destroy($cod);
    }

    public function BooksByAuthor(int $cod) {
        try {
            return \DB::table('livros_por_autor')->where('cod_autor', $cod)->get();
        } catch (\Exception $e) {
            throw new PDOException($e->getMessage());
        }
    }
}
