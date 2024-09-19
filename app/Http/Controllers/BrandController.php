<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::query()->paginate(5);
        return response()->json([
            "brands"=>$brands
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        $imageName= time().".".$request->image->getClientOriginalExtension();
        $request->image->move(public_path("/upload"),$imageName);
        Brand::create([
            "name"=>$request->name,
            "image"=>$imageName
        ]);
        return response()->json([
            "message"=>"brand added successfully"
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand = Brand::find($id);
        if(!$brand){
            return response()->json([
                "message"=>"Brand not found"
            ],404);
        }
        return response()->json([
            "brand"=>$brand
        ],200);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, string $id)
    {
        $brand = Brand::find($id);
        $image = $brand->image;
        if(!$brand){
            return response()->json([
                "message"=>"Brand not found"
            ],404);
        }
        if($request->has("image")){
            unlink(public_path("/upload/").$image);
            $imageName = time().".".$request->image->getClientOriginalExtension();
            $request->image->move(public_path("/upload"),$imageName);
            $image = $imageName;
        }
        $brand->update([
            "name"=>$request->name,
            "image"=>$image
        ]);
        return response()->json([
            "message"=>"brand updated successfully"
        ],205);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);
        unlink(public_path("/upload/").$brand->image);
        if(!$brand){
            return response()->json([
                "message"=>"Brand not found"
            ],404);
        }
        $brand->delete();
        return response()->json([
            "message"=>"brand deleted successfully"
        ],204);
    }
}
