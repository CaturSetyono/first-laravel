<?php

use Illuminate\Support\Facades\Route;

// Main landing page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
});
