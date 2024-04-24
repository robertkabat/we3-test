<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\Products\ProductController;
use Illuminate\Support\Facades\Route;

/*************************************************************************
 *
 * PROTECTED ACCOUNT QUOTES ROUTES
 *
 *************************************************************************/

Route::post('login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('products', [ProductController::class, 'index']);
});
