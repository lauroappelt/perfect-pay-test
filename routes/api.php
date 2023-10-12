<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Costomer\CreateCostomerController;
use App\Http\Controllers\Api\Costomer\UpdateCostomerController;
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
        Route::post('', CreateCostomerController::class)->name('api.costomer');
        Route::put('', UpdateCostomerController::class)->name('api.costomer');
    });
});