<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArchitectCollection;
use App\Http\Resources\ArchitectResource;
use App\Models\Architect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArchitectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $architects = Architect::all();
        return response()->json(new ArchitectCollection($architects));
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
            'name' => 'required|string|max:255|unique:architects',
            'skills' => 'required|string|max:255',
            'title' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $architects = Architect::create([
            'name' => $request->name,
            'skills' => $request->skills,
            'title' => $request->title,
        ]);

        return response()->json([
            'Architect created' => new ArchitectResource($architect)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Architect  $architect
     * @return \Illuminate\Http\Response
     */
    public function show($architect_id)
    {
        $architect = Architect::find($architect_id);
        if (is_null($architect)) {
            return response()->json('Architect not found', 404);
        }
        return response()->json(new ArchitectResource($architect));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Architect  $architect
     * @return \Illuminate\Http\Response
     */
    public function edit(Architect $architect)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Architect  $architect
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Architect $architect)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:architects',
            'skills' => 'required|string|max:255',
            'title' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $architect->name = $request->name;
        $architect->skills = $request->skills;
        $architect->title = $request->title;

        $architect->save();

        return response()->json([
            'Architect updated' => new ArchitectResource($architect)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Architect  $architect
     * @return \Illuminate\Http\Response
     */
    public function destroy(Architect $architect)
    {
        $architect->delete();

        return response()->json('Architect deleted');
    }
}
