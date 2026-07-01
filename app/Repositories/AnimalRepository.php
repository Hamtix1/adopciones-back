<?php

namespace App\Repositories;

use App\Models\Animal;

class AnimalRepository extends BaseRepository
{
    public function __construct(Animal $model)
    {
        parent::__construct($model);
    }

    public function publicList(array $filters = [], int $perPage = 20)
    {
        $query = $this->model->with(['shelter.municipality.department', 'status']);

        if (! empty($filters['species'])) {
            $query->where('species', $filters['species']);
        }

        if (! empty($filters['sex'])) {
            $query->where('sex', $filters['sex']);
        }

        if (! empty($filters['size'])) {
            $query->where('size', $filters['size']);
        }

        if (! empty($filters['municipality_id'])) {
            $query->whereHas('shelter', function ($q) use ($filters) {
                $q->where('municipality_id', $filters['municipality_id']);
            });
        }

        if (! empty($filters['shelter_id'])) {
            $query->where('shelter_id', $filters['shelter_id']);
        }

        if (! empty($filters['status'])) {
            $query->whereHas('status', function ($q) use ($filters) {
                $q->where('name', $filters['status']);
            });
        }

        if (isset($filters['sterilized'])) {
            $query->where('sterilized', (bool) $filters['sterilized']);
        }

        return $query->paginate($perPage);
    }
}
