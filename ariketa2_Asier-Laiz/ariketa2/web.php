<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/ikasleak', [StudentController::class, 'index'])->name('students.index');
Route::get('/ikasleak/{id}', [StudentController::class, 'show'])->name('students.show');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/historia', function () {
    return view('historia');
})->name('historia');

Route::get('/kokapena', function () {
    return view('kokapena');
})->name('kokapena');

Route::get('/ordutegia-eta-kontaktua', function () {
    return view('kontaktua');
})->name('kontaktua');
