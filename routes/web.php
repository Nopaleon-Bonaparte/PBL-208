<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/antrian-persetujuan', function () {
    return view('antrian-persetujuan');
});

Route::get('/data-masjid', function () {
    return view('data-masjid');
});
