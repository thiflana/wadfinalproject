<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductApiController;

// This route will now be registered correctly
Route::get('/products', [ProductApiController::class, 'index']);
