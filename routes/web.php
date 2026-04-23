<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    // 1. Hitung user
    $total_user = DB::table('user')->count();

    // 2. Hitung cabang (SESUAIKAN: status_keaktifan_cabang)
    $total_cabang = DB::table('cabang')->where('status_keaktifan_cabang', 'Aktif')->count();

    // 3. Hitung ranting (SESUAIKAN: status_keaktifan_ranting)
    $total_ranting = DB::table('ranting')->where('status_keaktifan_ranting', 'Aktif')->count();

    // 4. Hitung masjid
    $total_masjid = DB::table('masjid')->count();
    $masjid_terdaftar = DB::table('masjid')->where('status_legalitas', 'Terdaftar')->count();

    // Panggil tampilan dashboard kamu
    return view('superadmin.dashboard', compact(
        'total_user', 'total_cabang', 'total_ranting', 'total_masjid', 'masjid_terdaftar'
    ));
});

// Cadangan rute biar nggak bingung
Route::get('/dashboard', function () {
    return redirect('/');
});
