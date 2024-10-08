<?php

use App\Http\Controllers\AddressesController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ColorsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SizesController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\OnlyGetMethodMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware("auth:sanctum")->group(function(){
    Route::controller(ColorsController::class)->middleware(AdminMiddleware::class)->prefix("/colors")->group(function(){
        Route::get("/","index");
        Route::post("/","store");
        Route::get("/{id}","show");
        Route::put("/{id}","update");
        Route::delete("/{id}","destroy");
    });

    Route::controller(CategoriesController::class)->prefix("/categories")->group(function(){
        Route::get("/","index");
        Route::get("/{id}","show");
        Route::middleware(AdminMiddleware::class)->group(function(){
            Route::post("/","store");
            Route::put("/{id}","update");
            Route::delete("/{id}","destroy");
        });
    });

    Route::controller(BrandController::class)->prefix("/brands")->group(function(){
        Route::get("/","index");
        Route::get("/{id}","show");
        Route::middleware(AdminMiddleware::class)->group(function(){
            Route::post("/","store");
            Route::put("/{id}","update");
            Route::delete("/{id}","destroy");
        });
    });
    Route::controller(SizesController::class)->middleware(AdminMiddleware::class)->prefix("/sizes")->group(function(){
        Route::get("/","index");
        Route::post("/","store");
        Route::get("/{id}","show");
        Route::put("/{id}","update");
        Route::delete("/{id}","destroy");
    });

    Route::controller(OrdersController::class)->prefix("/orders")->group(function(){
        Route::post("/","store");
        Route::get("/user","getUserOrders");
        Route::post("/{id}/checkout","checkout");
        Route::middleware(AdminMiddleware::class)->group(function(){
            Route::get("/","index");
            Route::get("/{id}","show");
            Route::put("/{id}","updateStatus");
            Route::delete("/{id}","destroy");
        });
    });


    Route::controller(ProductsController::class)->middleware(OnlyGetMethodMiddleware::class)->prefix("/products")->group(function(){
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


    Route::controller(AddressesController::class)->prefix("/addresses")->group(function(){
        Route::get('/user',"getUserAddresses");
        Route::middleware(AdminMiddleware::class)->group(function(){
            Route::get("/","index");
            Route::post("/","store");
            Route::get("/{id}","show");
            Route::put("/{id}","update");
            Route::delete("/{id}","destroy");
        });
    });

    Route::controller(UserController::class)->middleware(AdminMiddleware::class)->prefix('/users')->group(function(){
        Route::get('/',"index");
        Route::post('/',"store");
        Route::get("/{id}","show");
        Route::delete("/{id}","destroy");
    });
    Route::controller(AuthController::class)->group(function(){
        Route::get("/user-profile","profile");
    });

});

Route::controller(AuthController::class)->group(function(){
    Route::post("/login","login");
    Route::post("/register","register");
});
