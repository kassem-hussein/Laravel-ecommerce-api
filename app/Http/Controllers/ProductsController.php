<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductStockRequest;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductStock;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;

class ProductsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::query()->paginate(5);
        return $this->sendSuccessWithResult("success",$products,200);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        Product::create($request->all());
        return $this->sendSuccess("Added Product Successfully",201);
    }

    public function productImages(String $id){
        $product = Product::find($id);
        if(!$product){
            return $this->sendError("Not Found",404);
        }
        $images = ProductImage::where("product",$id)->paginate(5);
        return $this->sendSuccessWithResult("success",$images,200);
    }
    public function addProductImage(Request $request,String $id){
        $request->validate([
            "image"=>"file|required|image|mimes:png,jpg"
        ]);
        $product = Product::find($id);
        if(!$product){
            return $this->sendError("Not Found",404);
        }
        $imageName = time().".".$request->image->getClientOriginalExtension();
        $request->image->move(public_path("/upload"),$imageName);

        ProductImage::create([
            "product"=>$product->id,
            "image"=>$imageName
        ]);
        return $this->sendSuccess("Added Image Successfully",200);
    }

    public function addProductStock(ProductStockRequest $request,String $id){
        try{
            $product = Product::find($id);
            if(!$product){
                return $this->sendError("Not Found",404);
            }
            ProductStock::create([
                "product"=>$product->id,
                "color"=>$request->color,
                "size"=>$request->size,
                "price"=>$request->price,
                "quantity"=>$request->quantity
            ]);
            return $this->sendSuccess("Added Product Stock successfully",201);

        }catch(UniqueConstraintViolationException){
                return $this->sendError("You are already Added this values for Poduct,Size,color ",400);
        }
    }

    public function productStocks(String $id){
        $stocks = ProductStock::where("product",$id)->paginate(5);
        return $this->sendSuccessWithResult("success",$stocks,200);

    }
    public function removeProductStock(String $id){
        $stock = ProductStock::find($id);
        if(!$stock){
            return $this->sendError("Not Found",404);
        }
        $stock->delete();
        return $this->sendSuccess("Deleted Product Stock Successfully",205);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        if(!$product){
            return $this->sendError("Not Found",404);
        }
        return $this->sendSuccessWithResult("success",$product,200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $product = Product::find($id);
        if(!$product){
            return $this->sendError("Not Found",404);
        }
        $product->update($request->all());
        return $this->sendSuccess("Updated Product Successfully",205);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if(!$product){
            return $this->sendError("Not Found",404);
        }
        $product->delete();
        return $this->sendSuccess("Deleted Product Successfully",204);
    }
}
