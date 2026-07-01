<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\Shelter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalAnimals = Animal::count();
        $totalShelters = Shelter::count();
        $availableForAdoption = Animal::where('available_for_adoption', true)->count();
        $adopted = Animal::where('adopted', true)->count();

        $speciesCounts = Animal::select('species', DB::raw('count(*) as total'))
            ->groupBy('species')
            ->get();

        $statusCounts = Animal::select('animal_status_id', DB::raw('count(*) as total'))
            ->with('status')
            ->groupBy('animal_status_id')
            ->get()
            ->map(fn ($item) => [
                'status' => $item->status?->name ?? 'Sin estado',
                'total' => $item->total,
            ]);

        $topShelters = Shelter::withCount([
            'animals',
            'animals as available_for_adoption_count' => fn ($query) => $query->where('available_for_adoption', true),
        ])
            ->orderByDesc('animals_count')
            ->take(5)
            ->get();

        $recentAnimals = Animal::with(['status', 'shelter'])
            ->latest('created_at')
            ->take(5)
            ->get(['id', 'name', 'species', 'animal_status_id', 'shelter_id', 'created_at']);

        $adoptionRate = $totalAnimals > 0
            ? round(($availableForAdoption / $totalAnimals) * 100, 1)
            : 0;

        return response()->json([
            'total_animals' => $totalAnimals,
            'total_shelters' => $totalShelters,
            'available_for_adoption' => $availableForAdoption,
            'adopted' => $adopted,
            'adoption_rate' => $adoptionRate,
            'species_counts' => $speciesCounts,
            'status_counts' => $statusCounts,
            'top_shelters' => $topShelters,
            'recent_animals' => $recentAnimals,
        ]);
    }
}
