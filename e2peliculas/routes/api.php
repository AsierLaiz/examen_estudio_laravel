<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\DirectorController;

Route::post('/directors', [DirectorController::class, 'store']);
Route::delete('/directors/{id}', [DirectorController::class, 'destroy']);
Route::get('/movies', [MovieController::class, 'index']);
Route::put('/directors/{director}', [DirectorController::class, 'update']);