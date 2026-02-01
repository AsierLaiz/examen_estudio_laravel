<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/historia',function(){
    return view('historia');
})->name('historia');
Route::get('/kokapena', function(){
    return view('kokapena');
})->name('kokapena');
Route::get('/ordutegia-eta-kontaktua', function(){
    return view('ord-eta-kon');
}) ->name('ordutegia-eta-kontaktua');
