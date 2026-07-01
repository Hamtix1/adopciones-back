<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShelterRequest;
use App\Http\Requests\UpdateShelterRequest;
use App\Models\Shelter;
use App\Services\ShelterService;
use Illuminate\Http\Request;

class ShelterController extends Controller
{
    public function __construct(protected ShelterService $service)
    {
    }

    public function index(Request $request)
    {
        $filters = $request->only(['municipality_id', 'status', 'search']);

        return response()->json($this->service->publicList($filters, $request->get('per_page', 15)));
    }

    public function store(StoreShelterRequest $request)
    {
        $shelter = $this->service->create($request->validated());

        return response()->json($shelter, 201);
    }

    public function show(Shelter $shelter)
    {
        return response()->json($shelter->load(['municipality.department', 'animals.status']));
    }

    public function update(UpdateShelterRequest $request, Shelter $shelter)
    {
        $shelter = $this->service->update($shelter->id, $request->validated());

        return response()->json($shelter);
    }

    public function destroy(Shelter $shelter)
    {
        $this->service->delete($shelter->id);

        return response()->json(null, 204);
    }
}
