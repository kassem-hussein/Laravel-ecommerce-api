<?php

namespace App\Http\Controllers;

use App\Http\Requests\SizeRequest;
use App\Models\Size;

class SizesController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sizes = Size::query()->paginate(5);
        return $this->sendSuccessWithResult("success",$sizes,200);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(SizeRequest $request)
    {
        Size::create($request->all());
        return $this->sendSuccess("Added size successfully",201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $size = Size::find($id);
        if(!$size){
            return $this->sendError("Not Found",404);
        }
        return $this->sendSuccessWithResult("success",$size,200);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(SizeRequest $request, string $id)
    {
        $size = Size::find($id);
        if(!$size){
            return $this->sendError("Not Found",404);
        }
        $size->update($request->all());
        return $this->sendSuccess("Updated Size successfully",205);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $size = Size::find($id);
        if(!$size){
            return $this->sendError("Not Found",404);
        }
        $size->delete();
        return $this->sendSuccess("deleted Size successfully",205);
    }
}
