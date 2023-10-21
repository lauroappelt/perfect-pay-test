<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Costomer\CostomerController;
use App\Http\Controllers\Api\Product\ProductController;
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


Route::post('login', LoginController::class)->name('api.login');

Route::middleware('auth:sanctum')->group(function(){
    Route::prefix('costomer')->group(function () {
        Route::post('', [CostomerController::class, 'createCostomer'])->name('api.costomer');
        Route::get('{id}', [CostomerController::class, 'getCostomer'])->name('api.costomer.get');
        Route::get('', [CostomerController::class, 'listCostomer'])->name('api.costomer.list');
        Route::put('{id}', [CostomerController::class, 'updateCostomer'])->name('api.costomer.update');
    });

    Route::prefix('product')->group(function () {
        Route::post('', [ProductController::class, 'createProduct'])->name('api.product.create');
        Route::get('', [ProductController::class, 'listProduct'])->name('api.product.list');
        Route::get('{id}', [ProductController::class, 'getProduct'])->name('api.product.get');
        Route::put('{id}', [ProductController::class, 'updateProduct'])->name('api.product.update');
    });
});