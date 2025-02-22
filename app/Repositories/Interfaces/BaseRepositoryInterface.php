<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseRepositoryInterface
{
    public function getAll(array $filters = []): LengthAwarePaginator;
    public function findById(int $id): ?Model;
    public function create(array $data): Model;
    public function update(Model $model, array $data): Model;
    public function delete(int $id): bool;
    public function getModel(): Model;
}
