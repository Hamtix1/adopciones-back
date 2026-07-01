<?php

namespace App\Services;

use App\Repositories\AnimalRepository;

class AnimalService extends BaseService
{
    public function __construct(AnimalRepository $repository)
    {
        parent::__construct($repository);
    }

    public function publicList(array $filters = [], int $perPage = 20)
    {
        return $this->repository->publicList($filters, $perPage);
    }
}
