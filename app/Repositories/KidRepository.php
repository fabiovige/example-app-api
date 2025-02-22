<?php

namespace App\Repositories;

use App\Models\Kid;
use App\Repositories\Interfaces\KidRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class KidRepository implements KidRepositoryInterface
{
    protected $model;

    public function __construct(Kid $model)
    {
        $this->model = $model;
    }

    public function getAll(array $filters = []): LengthAwarePaginator
    {
        return $this->model
            ->when(isset($filters['search']), function (Builder $query) use ($filters) {
                $search = $filters['search'];
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('gender', 'like', "%{$search}%")
                        ->orWhere('birth_date', 'like', "%{$search}%");
                });
            })
            ->when(isset($filters['name']), function ($query) use ($filters) {
                return $query->where('name', 'like', "%{$filters['name']}%");
            })
            ->when(isset($filters['gender']), function ($query) use ($filters) {
                return $query->where('gender', $filters['gender']);
            })
            ->when(isset($filters['birth_date']), function ($query) use ($filters) {
                return $query->whereDate('birth_date', $filters['birth_date']);
            })
            ->when(isset($filters['order_by']), function ($query) use ($filters) {
                $direction = $filters['order_direction'] ?? 'asc';
                return $query->orderBy($filters['order_by'], $direction);
            })
            ->paginate($filters['per_page'] ?? 10);
    }

    public function findById(int $id): ?Kid
    {
        return $this->model->find($id);
    }

    public function create(array $data): Kid
    {
        return $this->model->create($data);
    }

    public function update(Kid $kid, array $data): Kid
    {
        $kid->update($data);
        return $kid->fresh();
    }

    public function delete(int $id): bool
    {
        $kid = $this->findById($id);
        if (!$kid) {
            return false;
        }
        return $kid->delete();
    }
}
