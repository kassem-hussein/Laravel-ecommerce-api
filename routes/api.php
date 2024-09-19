<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ColorsController;
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
