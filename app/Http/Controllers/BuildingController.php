<?php

namespace App\Http\Controllers;

use App\Http\Resources\BuildingCollection;
use App\Http\Resources\BuildingResource;
use App\Models\Building;
use App\Models\Flat;
use App\Models\Architect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buildings = Building::all();
        return response()->json(new BuildingtCollection($buildings));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address' =>  'required|string|max:255',
            'city' =>  'required|string|max:255',
            'date_built' =>  'required|date',
            'architect_id' =>  'required|integer|max:255',
            'flat_id' =>  'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $architect = Architect::find($request->architect_id);
        if (is_null($architect)) {
            return response()->json('Architect not found', 404);
        }

        $flat = Flat::find($request->flat_id);
        if (is_null($flat)) {
            return response()->json('Flat not found', 404);
        }

        $building = Building::create([
            'address' => $request->address,
            'city' => $request->city,
            'date_built' => $request->date_built,
            'architect_id' => $request->architect_id,
            'flat_id' => $request->flat_id,
        ]);

        return response()->json([
            'Building created' => new BuildingResource($building)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function show($building_id)
    {
        $building = Building::find($building_id);
        if (is_null($building)) {
            return response()->json('Building not found', 404);
        }
        return response()->json(new BuildingResource($building));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function edit(Building $building)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Building $building)
    {
        $validator = Validator::make($request->all(), [
            'address' =>  'required|string|max:255',
            'city' =>  'required|string|max:255',
            'date_built' =>  'required|date',
            'architect_id' =>  'required|integer|max:255',
            'flat_id' =>  'required|integer|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $architect = Architect::find($request->architect_id);
        if (is_null($architect)) {
            return response()->json('Architect not found', 404);
        }

        $flat = Flat::find($request->flat_id);
        if (is_null($flat)) {
            return response()->json('Flat not found', 404);
        }

        $building->address = $request->address;
        $building->city = $request->city;
        $building->date_built = $request->date_built;
        $building->architect_id = $request->architect_id;
        $building->flat_id = $request->flat_id;

        $building->save();

        return response()->json([
            'Building updated' => new BuildingResource($building)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building $building)
    {
        $building->delete();

        return response()->json('Building deleted');
    }
}
