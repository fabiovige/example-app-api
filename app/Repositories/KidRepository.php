<?php

namespace App\Repositories;

use App\Models\Kid;
use App\Repositories\Interfaces\KidRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

class KidRepository extends BaseRepository implements KidRepositoryInterface
{
    public function __construct(Kid $model)
    {
        parent::__construct($model);
    }

    protected function getSearchableFields(): array
    {
        return ['name', 'gender', 'birth_date'];
    }

    protected function applyFilters(array $filters): Builder
    {
        return $this->model->newQuery()
            ->when(isset($filters['name']), function ($query) use ($filters) {
                return $query->where('name', 'like', "%{$filters['name']}%");
            })
            ->when(isset($filters['gender']), function ($query) use ($filters) {
                return $query->where('gender', $filters['gender']);
            })
            ->when(isset($filters['birth_date']), function ($query) use ($filters) {
                return $query->whereDate('birth_date', $filters['birth_date']);
            });
    }
}
