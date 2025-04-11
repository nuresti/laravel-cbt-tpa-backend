<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//login
Route::post('/login', [AuthController::class, 'login']);

//products
Route::apiResource('/products', ProductController::class)
    ->only(['index', 'show'])
    ->middleware('auth:sanctum');

//categories
Route::apiResource('/categories', CategoryController::class)
    ->only(['index', 'show'])
    ->middleware('auth:sanctum');
