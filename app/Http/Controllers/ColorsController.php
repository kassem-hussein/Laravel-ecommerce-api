<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColorRequest;
use App\Models\Color;


class ColorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors = Color::query()->paginate(5);
        return response()->json([
            "colors"=>$colors
        ], 200);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(ColorRequest $request)
    {
        Color::create($request->all());
        return response()->json([
                "message"=>"Color Added Successfully",
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $color = Color::find($id);
        if(!$color){
            return response()->json([
                "message"=>"color not found"
            ],404);
        }
        return response()->json([
            "color"=>$color
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ColorRequest $request, string $id)
    {
        $color = Color::find($id);
        if(!$color){
            return response()->json([
                "message"=>"Color not Found"
            ],404);
        }
        $color->update($request->all());
        return response()->json([
            "message"=>"Color updated Successfuly"
        ],205);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $color  = Color::find($id);
        if(!$color){
            return response()->josn([
                "message"=>"color not found"
            ],404);
        }
        $color->delete();
        return response()->json([
            "message"=>"color deleted successfully"
        ],204);
    }
}
