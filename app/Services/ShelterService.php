<?php

namespace App\Services;

use App\Repositories\ShelterRepository;

class ShelterService extends BaseService
{
    public function __construct(ShelterRepository $repository)
    {
        parent::__construct($repository);
    }

    public function publicList(array $filters = [], int $perPage = 15)
    {
        return $this->repository->publicList($filters, $perPage);
    }
}
