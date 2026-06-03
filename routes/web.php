<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\AdminCabangController;
use App\Http\Controllers\AdminRantingController;
use App\Http\Controllers\PengurusMasjidController;

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

// 4. Rute Superadmin
Route::get('/superadmin/persetujuan', [SuperadminController::class, 'persetujuan']);
Route::get('/superadmin/riwayat', [SuperadminController::class, 'riwayat']);

// 5. Route Monitoring Cabang & Ranting
Route::get('/superadmin/status-cabang', function () {
    return view('superadmin.status-cabang');
});

Route::get('/superadmin/status-ranting', function () {
    return view('superadmin.status-ranting');
});

// 6. Route untuk Status Masjid dan Musholla
Route::get('/superadmin/status-masjid', function () {
    return view('superadmin.status-masjid');
});

// 7. Route untuk Tambah Data Masjid/Musholla
Route::get('/superadmin/status-masjid/tambah', function () {
    return view('superadmin.tambah-masjid');
});

Route::post('/superadmin/status-masjid/simpan', function (Request $request) {
    return redirect('/superadmin/status-masjid')->with('success', 'Data tempat ibadah berhasil ditambahkan!');
});

// 8. Route Admin Cabang
Route::get('/admin-cabang/dashboard', [AdminCabangController::class, 'dashboard']);

// 9. Route Admin Ranting
Route::get('/admin-ranting/dashboard', [AdminRantingController::class, 'dashboard']);

// 10. Route Pengurus Masjid
Route::get('/pengurus-masjid/dashboard', [PengurusMasjidController::class, 'dashboard']);
