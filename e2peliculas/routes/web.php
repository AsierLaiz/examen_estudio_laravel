<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DirectorController;

Route::get('/', [DirectorController::class, 'index'] )->name('director.index');
Route::get('/director/{director}', [DirectorController::class, 'show'] )->name('director.show');
