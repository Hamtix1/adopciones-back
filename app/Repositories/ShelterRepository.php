<?php

namespace App\Repositories;

use App\Models\Shelter;

class ShelterRepository extends BaseRepository
{
    public function __construct(Shelter $model)
    {
        parent::__construct($model);
    }

    public function publicList(array $filters = [], int $perPage = 15)
    {
        $query = $this->model->with('municipality')
            ->withCount('animals');

        if (! empty($filters['municipality_id'])) {
            $query->where('municipality_id', $filters['municipality_id']);
        }

        if (! empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (! empty($filters['search'])) {
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        return $query->paginate($perPage);
    }
}
