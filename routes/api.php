<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\SearchController;

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

// Public API routes for product synchronization
Route::prefix('v1')->name('api.')->group(function () {
    // Product API routes
    Route::apiResource('products', ProductApiController::class);
    Route::post('products/{product}/toggle-status', [ProductApiController::class, 'toggleStatus'])->name('products.toggle-status');
    Route::get('products/{product}/pricing', [ProductApiController::class, 'pricing'])->name('products.pricing');
    Route::post('products/{product}/pricing', [ProductApiController::class, 'addPricing'])->name('products.add-pricing');
    Route::get('statistics', [ProductApiController::class, 'statistics'])->name('statistics');
});

// Search API routes - Public
Route::get('/search/live', [SearchController::class, 'liveSearch']);

// Admin API routes for other functionality
Route::middleware(['auth', 'admin'])->group(function () {
    // Add other admin-only API routes here
});