<?php

namespace App\Repositories;

use App\Models\Assunto;
use App\Repositories\Contracts\AssuntoRepositoryInterface;

class AssuntoRespository implements AssuntoRepositoryInterface {
    public function __construct(private Assunto $assunto) {}

    public function list(array $filters)
    {
        return $this->assunto
            ->when(isset($filters['term']), function ($q) use ($filters) {
                $q->where('descricao', 'like', '%' . $filters['term'] . '%');
            })
            ->paginate();
    }

    public function count(?array $filters)
    {
        return $this->assunto
            ->when(isset($filters['term']), function ($q) use ($filters) {
                $q->where('descricao', 'like', '%' . $filters['term'] . '%');
            })
            ->count();
    }

    public function show(int $cod)
    {
        return $this->assunto->find($cod);
    }

    public function store(array $data)
    {
        return $this->assunto->create($data);
    }

    public function update(int $cod, array $data)
    {
        $item = $this->assunto->find($cod);
        return $item->update($data);
    }

    public function destroy(int $cod)
    {
        return $this->assunto->destroy($cod);
    }
}