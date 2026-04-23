<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;

// Halaman awal lempar ke login
Route::get('/', function () {
    return redirect('/login');
});

// Urusan Login & Logout
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- AREA TERKUNCI ---
Route::get('/dashboard', function () {
    // Cek apakah bawa tiket session? Kalau nggak, tendang ke login!
    if (!session('is_logged_in')) {
        return redirect('/login')->withErrors(['loginError' => 'Login dulu bos!']);
    }

    // Ambil data kalau berhasil masuk
    $total_user = DB::table('user')->count();
    $total_cabang = DB::table('cabang')->where('status_keaktifan_cabang', 'Aktif')->count();
    $total_ranting = DB::table('ranting')->where('status_keaktifan_ranting', 'Aktif')->count();
    $total_masjid = DB::table('masjid')->count();
    $masjid_terdaftar = DB::table('masjid')->where('status_legalitas', 'Terdaftar')->count();

    return view('superadmin.dashboard', compact(
        'total_user', 'total_cabang', 'total_ranting', 'total_masjid', 'masjid_terdaftar'
    ));
});
