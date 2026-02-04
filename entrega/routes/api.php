<?php


use App\Http\Controllers\Api\AuthorController as ApiAuthorController;
use App\Http\Controllers\Api\BookController as ApiBookController;

Route::post('/authors', [ApiAuthorController::class, 'store']);
Route::delete('/authors/{id}', [ApiAuthorController::class, 'destroy']);
Route::get('/books', [ApiBookController::class, 'index']);
