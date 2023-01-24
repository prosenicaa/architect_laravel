<?php

namespace App\Http\Controllers;

use App\Http\Resources\FlatCollection;
use App\Http\Resources\FlatResource;
use App\Models\Flat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flats = Flat::all();
        return response()->json(new FlatCollection($flats));
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
            'floor' => 'required|integer|between:0,20',
            'max_people' => 'required|sinteger|between:1,5',
            'balcony' => 'required|string|max:3',
            'price' => 'required|integer|between:2000,300000',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $flat = Flat::create([
            'floor' => $request->floor,
            'max_people' => $request->max_people,
            'balcony' => $request->balcony,
            'price' => $request->price,
        ]);

        return response()->json([
            'Flat created' => new FlatResource($flat)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function show($flat_id)
    {
        $flat = Flat::find($flat_id);
        if (is_null($flat)) {
            return response()->json('Flat not found', 404);
        }
        return response()->json(new FlatResource($flat));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function edit(Flat $flat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flat $flat)
    {
        $validator = Validator::make($request->all(), [
            'floor' => 'required|integer|between:0,20',
            'max_people' => 'required|sinteger|between:1,5',
            'balcony' => 'required|string|max:3',
            'price' => 'required|integer|between:2000,300000',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $flat->floor = $request->floor;
        $flat->max_people = $request->max_people;
        $flat->balcony = $request->address;
        $flat->price = $request->price;

        $flat->save();

        return response()->json([
            'Flat updated' => new FlatResource($flat)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flat $flat)
    {
        $flat->delete();

        return response()->json('Flat deleted');
    }
}
