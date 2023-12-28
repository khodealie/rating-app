<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
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

// Routes for Provider
Route::apiResource('providers', ProviderController::class);

// Nested Routes for Products under Providers
Route::apiResource('providers.products', ProductController::class)
    ->shallow();
