<?php

namespace App\Repositories\Interfaces;

use App\Models\Kid;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface KidRepositoryInterface
{
    public function getAll(array $filters = []): LengthAwarePaginator;
    public function findById(int $id): ?Kid;
    public function create(array $data): Kid;
    public function update(Kid $kid, array $data): Kid;
    public function delete(int $id): bool;
}
