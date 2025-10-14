<?php

use Illuminate\Support\Facades\Route;

// Main landing page
Route::get('/', function () {
    return view('home');
});

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard');
});
