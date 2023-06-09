<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// PRODUCTS ENDPOINTS
//? MENCIONAR CONVENCIONES DE NOMBRE DE FUNCIONES
Route::get('/products',         [ ProductController::class, 'index'     ]);
Route::get('/products/{id}',    [ ProductController::class, 'show'      ]);
Route::post('/products',        [ ProductController::class, 'store'     ]);
Route::patch('/products/{id}',  [ ProductController::class, 'update'    ]);
Route::delete('/products/{id}', [ ProductController::class, 'destroy'   ]);


// CATEGORIES ENDPOINTS
Route::get('/categories',         [ CategoryController::class, 'index'     ]);
Route::get('/categories/{id}',    [ CategoryController::class, 'show'      ]);
Route::post('/categories',        [ CategoryController::class, 'store'     ]);
Route::patch('/categories/{id}',  [ CategoryController::class, 'update'    ]);
Route::delete('/categories/{id}', [ CategoryController::class, 'destroy'   ]);
