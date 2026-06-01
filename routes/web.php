<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperadminController;

// 1. Awal
Route::get('/', function () { return redirect('/login'); });

// 2. Login & Logout
Route::get('/login', function () {
    if (session('is_logged_in')) return redirect('/dashboard');
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 3. Dashboard (Mengarah ke Controller)
Route::get('/dashboard', [SuperadminController::class, 'index']);

// 4. Rute Superadmin (Mengarah ke Controller)
Route::get('/superadmin/persetujuan', [SuperadminController::class, 'persetujuan']);
Route::get('/superadmin/riwayat', [SuperadminController::class, 'riwayat']);

// 5. Route Monitoring Cabang & Ranting (Direct View)
Route::get('/superadmin/status-cabang', function () {
    return view('superadmin.status-cabang');
});

Route::get('/superadmin/status-ranting', function () {
    return view('superadmin.status-ranting');
});

// 6.Route untuk Status Masjid dan Musholla
Route::get('/superadmin/status-masjid', function () {
    return view('superadmin.status-masjid');
});
