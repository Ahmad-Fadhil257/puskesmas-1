<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cara', function () {
    return view('cara');
})->name('cara');

Route::get('/testimoni', function () {
    return view('testimoni');
})->name('testimoni');
