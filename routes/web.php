<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\AdminCabangController;
use App\Http\Controllers\AdminRantingController;
use App\Http\Controllers\PengurusMasjidController;

// 1. Awal
Route::get('/', function () {
    return redirect('/login');
});

// 2. Login & Logout (Sudah diperbaiki agar tidak looping)
Route::get('/login', function () {
    if (session('is_logged_in')) {
        // Arahkan sesuai dengan hak akses (role) masing-masing
        if (session('id_role') == 'R01') {
            return redirect('/admin-cabang/dashboard');
        } elseif (session('id_role') == 'R03') {
            return redirect('/admin-ranting/dashboard');
        } elseif (session('id_role') == 'pengurus_masjid') {
            return redirect('/pengurus-masjid/dashboard');
        }

        // Default akan masuk ke dashboard superadmin
        return redirect('/dashboard');
    }
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 3. Dashboard Superadmin
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

// 6. Route untuk Status Masjid dan Musholla (Superadmin cuma bisa lihat)
Route::get('/superadmin/status-masjid', function () {
    return view('superadmin.status-masjid');
});

// 7. Route Tambah Data DIMATIKAN untuk Superadmin
/*
Route::get('/superadmin/status-masjid/tambah', function () {
    return view('superadmin.tambah-masjid');
});

Route::post('/superadmin/status-masjid/simpan', function (Request $request) {
    return redirect('/superadmin/status-masjid')->with('success', 'Data tempat ibadah berhasil ditambahkan!');
});
*/

// 8. Route Admin Cabang
Route::get('/admin-cabang/dashboard', [AdminCabangController::class, 'dashboard']);
// Rute untuk Cabang (Lihat Tabel, Tambah, Simpan)
Route::get('/admin-cabang/masjid', [AdminCabangController::class, 'indexMasjid']);
Route::get('/admin-cabang/masjid/tambah', [AdminCabangController::class, 'tambahMasjid']);
Route::post('/admin-cabang/masjid/simpan', [AdminCabangController::class, 'simpanMasjid']);

// 9. Route Admin Ranting
Route::get('/admin-ranting/dashboard', [AdminRantingController::class, 'dashboard']);
// Rute untuk Ranting (Lihat Tabel, Tambah, Simpan)
Route::get('/admin-ranting/masjid', [AdminRantingController::class, 'indexMasjid']);
Route::get('/admin-ranting/masjid/tambah', [AdminRantingController::class, 'tambahMasjid']);
Route::post('/admin-ranting/masjid/simpan', [AdminRantingController::class, 'simpanMasjid']);

// 10. Route Pengurus Masjid
Route::get('/pengurus-masjid/dashboard', [PengurusMasjidController::class, 'dashboard']);
