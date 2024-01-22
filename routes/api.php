<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('mainAPI/{class}', [APIController::class, 'index']);
// Route::post('mainAPI/{class}', [APIController::class, 'store']);
// Route::get('mainAPI/{class}/{id}', [APIController::class, 'show']);
// Route::put('mainAPI/{class}/{id}', [APIController::class, 'update']);
// Route::delete('mainAPI/{class}/{id}', [APIController::class, 'destroy']);

Route::apiResource('mainAPI/{class}', APIController::class);