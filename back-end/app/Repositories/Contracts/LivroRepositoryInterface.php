<?php

namespace App\Repositories\Contracts;

interface LivroRepositoryInterface {

    public function list(array $filters);

    public function count(?array $filters);

    public function show(int $cod);

    public function store(array $data);

    public function update(int $cod, array $data);

    public function destroy(int $cod);
}
