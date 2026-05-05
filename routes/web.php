<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;

// 1. Halaman awal otomatis lempar ke login
Route::get('/', function () {
    return redirect('/login');
});

// 2. Urusan Login & Logout
Route::get('/login', function () {
    // Jika sudah login, jangan kasih halaman login lagi, langsung lempar ke dashboard
    if (session('is_logged_in')) {
        return redirect('/dashboard');
    }
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// 3. AREA DASHBOARD (Multi-Role)
Route::get('/dashboard', function () {
    // Proteksi: Cek apakah user sudah login?
    if (!session('is_logged_in')) {
        return redirect('/login')->withErrors(['loginError' => 'Login dulu bos!']);
    }

    // Ambil data umum dari database
    $total_user = DB::table('user')->count();
    $total_cabang = DB::table('cabang')->where('status_keaktifan_cabang', 'Aktif')->count();
    $total_ranting = DB::table('ranting')->where('status_keaktifan_ranting', 'Aktif')->count();
    $total_masjid = DB::table('masjid')->count();
    $masjid_terdaftar = DB::table('masjid')->where('status_legalitas', 'Terdaftar')->count();

    // --- LOGIKA PEMBAGIAN DASHBOARD BERDASARKAN ROLE ---

    if (session('id_role') == 'R99') {
        // Jika Superadmin (Pusat): Tampilkan semua data
        return view('superadmin.dashboard', compact(
            'total_user',
            'total_cabang',
            'total_ranting',
            'total_masjid',
            'masjid_terdaftar'
        ));
    }
    else if (session('id_role') == 'R01') {
        // Jika Admin Cabang (Wilayah): Tampilkan data yang relevan saja
        return view('admin_cabang.dashboard', compact(
            'total_ranting',
            'total_masjid'
        ));
    }
    else if (session('id_role') == 'R03') {
        // Jika Admin Ranting (Kelurahan): Tampilkan dashboard ranting
        return view('admin_ranting.dashboard');
    }
    else if (session('id_role') == 'R02') {
        // Jika Pengurus Masjid (Takmir): Tampilkan dashboard masjid
        return view('pengurus_masjid.dashboard');
    }

    // Jika masuk tapi role-nya tidak dikenal
    return "Maaf, akun Anda tidak memiliki akses ke halaman dashboard manapun.";
});

// --- RUTE HALAMAN DALAM SUPERADMIN ---
Route::get('/superadmin/persetujuan', function () {
    // Pastikan cuma Superadmin (R99) yang bisa buka
    if (session('id_role') != 'R99') {
        return redirect('/dashboard');
    }
    return view('superadmin.persetujuan');
});
