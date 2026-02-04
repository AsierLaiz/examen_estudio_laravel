<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;

Route::get('/', function () {
    return response()->json([
        'message' => 'API Laravel - Sistema de Autores y Libros',
        'version' => '1.0',
        'endpoints' => [
            'POST /api/login' => 'Iniciar sesión',
            'POST /api/logout' => 'Cerrar sesión (requiere auth)',
            'GET /api/authors' => 'Listar autores (requiere auth)',
            'GET /api/books' => 'Listar libros (requiere auth)',
        ]
    ]);
});

// Rutas web de vistas
Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
Route::get('/authors/{author}', [AuthorController::class, 'show'])->name('authors.show'); 