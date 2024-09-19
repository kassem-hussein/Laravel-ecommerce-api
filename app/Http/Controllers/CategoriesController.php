<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::query()->paginate(5);
        return response()->json([
            "categories"=>$categories
        ],200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('/upload'), $imageName);
        Category::create([
            "name"=>$request->name,
            "image"=>$imageName
        ]);
        return response()->json([
            "message"=>"category Added Successfully"
        ],201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if(!$category){
            return response()->json([
                "message"=>"Category Not found"
            ],404);
        }
        return response()->json([
            "category"=>$category
        ],200);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::find($id);
        $image = $category->image;
        if(!$category){
            return response()->json([
                "message"=>"category not found"
            ],404);
        }
        if($request->has("image")){
            unlink(public_path("/upload/").$image);
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('/upload'), $imageName);
            $image = $imageName;
        }
        $category->update([
            "name"=>$request->name,
            "image"=>$image
        ]);
        return response()->json([
            "message"=>"Category Updated Successfully"
        ],205);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        unlink(public_path("/upload/").$category->image);
        if(!$category){
            return response()->json([
                "message"=>"category not found"
            ],404);
        }
        $category->delete();
        return response()->json([
            "message"=>"category deleted successfully"
        ],204);
    }
}
