<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\VoteController;
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

// Route for getting products from all providers
Route::get('products', [ProductController::class, 'indexFromAllProviders']);

// Nested Routes for Comments under Products
Route::apiResource('products.comments', CommentController::class)
    ->shallow();

// Nested Routes for Votes under Products
Route::apiResource('products.votes', VoteController::class)
    ->shallow();
