<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(array $filters = []): LengthAwarePaginator
    {
        return $this->model
            ->when(isset($filters['search']), function (Builder $query) use ($filters) {
                $search = $filters['search'];
                return $query->where(function ($query) use ($search) {
                    foreach ($this->getSearchableFields() as $field) {
                        $query->orWhere($field, 'like', "%{$search}%");
                    }
                });
            })
            ->when(isset($filters['order_by']), function ($query) use ($filters) {
                $direction = $filters['order_direction'] ?? 'asc';
                return $query->orderBy($filters['order_by'], $direction);
            })
            ->when($this->applyFilters($filters), function ($query) use ($filters) {
                return $this->applyFilters($filters);
            })
            ->paginate($filters['per_page'] ?? 10);
    }

    public function findById(int $id): ?Model
    {
        return $this->model->find($id);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(Model $model, array $data): Model
    {
        $model->update($data);
        return $model->fresh();
    }

    public function delete(int $id): bool
    {
        $model = $this->findById($id);
        if (!$model) {
            return false;
        }
        return $model->delete();
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * Campos que podem ser pesquisados no search geral
     */
    abstract protected function getSearchableFields(): array;

    /**
     * Filtros específicos para cada modelo
     */
    protected function applyFilters(array $filters): Builder
    {
        return $this->model->newQuery();
    }
}
