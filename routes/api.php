<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/ME', [AuthController::class, 'ME'])->middleware('auth:sanctum');
    Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});


Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/create-order', function(){
    return 'create order';
    })->middleware(['AbleCreateOrder']);

    Route::post('/admin-panel', function(){
    return 'admin panel';
    })->middleware(['AbleAdminPanel']);

});
