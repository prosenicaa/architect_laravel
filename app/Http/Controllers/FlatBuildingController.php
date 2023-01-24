<?php

namespace App\Http\Controllers;

use App\Http\Resources\BuildingCollection;
use App\Models\Building;
use App\Models\Flat;
use Illuminate\Http\Request;

class FlatBuildingController extends Controller
{
    public function index($flat_id)
    {
        $flat = Flat::find($flat_id);
        if (is_null($flat)) {
            return response()->json('Flat not found', 404);
        }

        $buildings = Building::get()->where('flat_id', $flat_id);
        if (is_null($buildings)) {
            return response()->json('Buildigs not found', 404);
        }

        return response()->json([
            'flat' => $flat->floor,
            'buildings' => new BuildingsCollection($buildings)
        ]);
    }
}
