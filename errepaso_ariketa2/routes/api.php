<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthorController as ApiAuthorController;
use App\Http\Controllers\Api\BookController as ApiBookController;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Authors
    Route::get('/authors', [ApiAuthorController::class, 'index']);
    Route::get('/authors/{author}', [ApiAuthorController::class, 'show']);
    Route::post('/authors', [ApiAuthorController::class, 'store']);
    Route::delete('/authors/{id}', [ApiAuthorController::class, 'destroy']);
    
    Route::get('/books', [ApiBookController::class, 'index']);
});
