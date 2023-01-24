<?php

namespace App\Http\Controllers;

use App\Http\Resources\BuildingCollection;
use App\Models\Building;
use App\Models\Architect;
use Illuminate\Http\Request;

class ArchitectBuildingController extends Controller
{
    public function index($architect_id)
    {
        $architect = Architect::find($architect_id);
        if (is_null($architect)) {
            return response()->json('Architect not found', 404);
        }

        $buildings = Building::get()->where('architect_id', $architect_id);
        if (is_null($buildings)) {
            return response()->json('Buildings not found', 404);
        }

        return response()->json([
            'architect' => $architect->name,
            'buildings' => new BuildingCollection($buildings)
        ]);
    }
}
