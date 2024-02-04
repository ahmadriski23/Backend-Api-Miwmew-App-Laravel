<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryApiController;
use App\Http\Controllers\ProductApiController;
use App\Http\Controllers\SupplyApiController;
use App\Http\Controllers\SupplyCategoryApiController;
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

Route::post('/register', [AuthController::class, 'createUser']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/check-email-exists', [AuthController::class, 'checkEmailExists']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::prefix('category')->middleware('auth:sanctum')->group(function () {
    Route::get('', [CategoryApiController::class, 'get']);
    Route::post('', [CategoryApiController::class, 'create']);
    Route::put('{id}', [CategoryApiController::class, 'update']);
    Route::delete('{id}', [CategoryApiController::class, 'delete']);
});

Route::prefix('products')->middleware('auth:sanctum')->group(function () {
    Route::get('', [ProductApiController::class, 'get']);
    Route::get('category/{categoryId}', [ProductApiController::class, 'getByCategoryId']);
    Route::post('', [ProductApiController::class, 'create']);
    Route::put('{id}', [ProductApiController::class, 'update']);
    Route::delete('{id}', [ProductApiController::class, 'delete']);
});

Route::prefix('supplyCategory')->middleware('auth:sanctum')->group(function () {
    Route::get('', [SupplyCategoryApiController::class, 'get']);
    Route::post('', [SupplyCategoryApiController::class, 'create']);
    Route::put('{id}', [SupplyCategoryApiController::class, 'update']);
    Route::delete('{id}', [SupplyCategoryApiController::class, 'delete']);
});

Route::prefix('supply')->middleware('auth:sanctum')->group(function () {
    Route::get('', [SupplyApiController::class, 'get']);
    Route::get('supplyCategoryId/{supplyCategoryId}', [SupplyApiController::class, 'getByCategoryId']);
    Route::post('', [SupplyApiController::class, 'create']);
    Route::put('{id}', [SupplyApiController::class, 'update']);
    Route::delete('{id}', [SupplyApiController::class, 'delete']);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
