<?php

use App\Http\Controllers\IngredientController;
use App\Http\Controllers\Manufacturer;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\NutritionalFactController;
use App\Http\Controllers\Product;
use App\Http\Controllers\Ingredient;
use App\Http\Controllers\Nutritional_fact;

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
Route::resource('/manufacturer', ManufacturerController::class);
// Route::get('/manufacturer', [ManufacturerController::class, 'index']);
Route::resource('/product', ProductController::class)->middleware('authMiddleware');
Route::resource('/ingredient', IngredientController::class);
Route::resource('/nutritional_fact', NutritionalFactController::class);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
