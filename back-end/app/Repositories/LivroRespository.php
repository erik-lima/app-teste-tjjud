<?php

namespace App\Repositories;

use App\Models\Livro;
use App\Repositories\Contracts\LivroRepositoryInterface;

class LivroRespository implements LivroRepositoryInterface
{
    public function __construct(private Livro $livro) {}

    public function list(array $filters)
    {
        return $this->livro
            ->when(isset($filters['term']), function ($q) use ($filters) {
                $q->where('titulo', 'like', '%' . $filters['term'] . '%');
            })
            ->paginate();
    }

    public function show(int $cod)
    {
        return $this->livro->find($cod);
    }

    public function store(array $data)
    {
        return $this->livro->create($data);
    }

    public function update(int $cod, array $data)
    {
        $item = $this->livro->find($cod);
        return $item->update($data);
    }

    public function destroy(int $cod)
    {
        return $this->livro->destroy($cod);
    }
}
