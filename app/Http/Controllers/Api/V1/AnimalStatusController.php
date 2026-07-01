<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\AnimalStatus;
use Illuminate\Http\Request;

class AnimalStatusController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(AnimalStatus::orderBy('name')->get());
    }
}
