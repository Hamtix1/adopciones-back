<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnimalRequest;
use App\Http\Requests\UpdateAnimalRequest;
use App\Models\Animal;
use App\Services\AnimalService;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function __construct(protected AnimalService $service)
    {
    }

    public function index(Request $request)
    {
        $filters = $request->only([
            'species',
            'sex',
            'size',
            'municipality_id',
            'shelter_id',
            'status',
            'sterilized',
        ]);

        return response()->json($this->service->publicList($filters, $request->get('per_page', 20)));
    }

    public function store(StoreAnimalRequest $request)
    {
        $animal = $this->service->create($request->validated());

        return response()->json($animal, 201);
    }

    public function show(Animal $animal)
    {
        return response()->json($animal->load(['shelter.municipality.department', 'status', 'images']));
    }

    public function update(UpdateAnimalRequest $request, Animal $animal)
    {
        $animal = $this->service->update($animal->id, $request->validated());

        return response()->json($animal);
    }

    public function destroy(Animal $animal)
    {
        $this->service->delete($animal->id);

        return response()->json(null, 204);
    }
}
