<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
//     Route::post('/auth/logout',   [ AuthController::class, 'logout'  ]);

// });

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //! MOVER ACA POR QUE ASI OPTENEMOS AL USUARIO CON SU TOKEN
    Route::post('/auth/logout',   [ AuthController::class, 'logout'  ]);

});

// PRODUCTS ENDPOINTS
//? MENCIONAR CONVENCIONES DE NOMBRE DE FUNCIONES
Route::get('/products',         [ ProductController::class, 'index'     ]);
Route::get('/products/{id}',    [ ProductController::class, 'show'      ]);
Route::post('/products',        [ ProductController::class, 'store'     ]);
Route::patch('/products/{id}',  [ ProductController::class, 'update'    ]);
Route::delete('/products/{id}', [ ProductController::class, 'destroy'   ]);


// CATEGORIES ENDPOINTS
Route::apiResource('/categories', CategoryController::class);

// AUTH ENDPOINTS
Route::post('/auth/login',    [ AuthController::class, 'login'   ]);
Route::post('/auth/register', [ AuthController::class, 'register']);

// IMAGES
Route::apiResource('/upload', ImageController::class);


// SALES
Route::apiResource('/sales', SaleController::class);

