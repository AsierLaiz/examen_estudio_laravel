<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GroupController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/historia',function(){
    return view('historia');
})->name('historia');

Route::get('/kokapena',function(){
    return view('kokapena');
})->name('kokapena');
Route::get('/ordutegia-eta-kontaktua',function(){
    return view('ordutegia-eta-kontaktua');
})->name('kontaktua');
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');
Route::get('/groups', [GroupController::class, 'index'])->name('groups.index');
Route::get('/groups/{group}', [GroupController::class, 'show'])->name('groups.show');