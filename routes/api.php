<?php

use App\Http\Controllers\AddressesController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ColorsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SizesController;
use App\Http\Requests\BrandRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::controller(ColorsController::class)->prefix("/colors")->group(function(){
    Route::get("/","index");
    Route::post("/","store");
    Route::get("/{id}","show");
    Route::put("/{id}","update");
    Route::delete("/{id}","destroy");
});

Route::controller(CategoriesController::class)->prefix("/categories")->group(function(){
    Route::get("/","index");
    Route::post("/","store");
    Route::get("/{id}","show");
    Route::put("/{id}","update");
    Route::delete("/{id}","destroy");
});

Route::controller(BrandController::class)->prefix("/brands")->group(function(){
    Route::get("/","index");
    Route::post("/","store");
    Route::get("/{id}","show");
    Route::put("/{id}","update");
    Route::delete("/{id}","destroy");
});
Route::controller(SizesController::class)->prefix("/sizes")->group(function(){
    Route::get("/","index");
    Route::post("/","store");
    Route::get("/{id}","show");
    Route::put("/{id}","update");
    Route::delete("/{id}","destroy");
});


Route::controller(ProductsController::class)->prefix("/products")->group(function(){
    Route::get("/","index");
    Route::post("/","store");
    Route::delete("/stocks/{id}","removeProductStock");
    Route::get("/{id}","show");
    Route::get("/{id}/images","productImages");
    Route::post("/{id}/images","addProductImage");
    Route::get("/{id}/stocks","productStocks");
    Route::post("/{id}/stocks","addProductStock");
    Route::put("/{id}","update");
    Route::delete("/{id}","destroy");
});


Route::controller(AddressesController::class)->middleware("auth:sanctum")->prefix("/addresses")->group(function(){
    Route::get("/","index");
    Route::post("/","store");
    Route::get("/{id}","show");
    Route::put("/{id}","update");
    Route::delete("/{id}","destroy");
});
Route::controller(AuthController::class)->middleware('guest')->group(function(){
    Route::post("/login","login");
    Route::post("/register","register");
});

Route::controller(AuthController::class)->middleware("auth:sanctum")->group(function(){
    Route::get("/user-profile","profile");
});
