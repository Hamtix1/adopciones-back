<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Shelter;
use Illuminate\Http\Request;

class ShelterListController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(Shelter::orderBy('name')->get());
    }
}
