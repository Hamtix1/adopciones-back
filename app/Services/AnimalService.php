<?php

namespace App\Services;

use App\Repositories\AnimalRepository;
use Illuminate\Support\Facades\Storage;

class AnimalService extends BaseService
{
    public function __construct(AnimalRepository $repository)
    {
        parent::__construct($repository);
    }

    public function update(int $id, array $data)
    {
        $image = $data['image'] ?? null;
        unset($data['image']);

        $animal = parent::update($id, $data);

        if ($image && $image->isValid()) {
            $path = $image->store('animals', 'public');
            $animal->images()->updateOrCreate(
                ['is_primary' => true],
                ['path' => $path]
            );
        }

        return $animal;
    }

    public function create(array $data)
    {
        $image = $data['image'] ?? null;
        unset($data['image']);

        $animal = parent::create($data);

        if ($image && $image->isValid()) {
            $path = $image->store('animals', 'public');
            $animal->images()->create([
                'path' => $path,
                'is_primary' => true,
            ]);
        }

        return $animal;
    }
}
