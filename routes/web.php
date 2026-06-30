<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AkunAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LegalitasController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\TakmirController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\MasjidController;

// ── Root ──
Route::get('/', fn() => redirect('/login'));

// ── Auth ──
Route::get('/login', function () {
    if (session('is_logged_in')) return redirect('/dashboard');
    return view('login');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ── Dashboard (role-based redirect) ──
Route::get('/dashboard', function () {
    if (!session('is_logged_in'))
        return redirect('/login')->withErrors(['loginError' => 'Login dulu']);

    return match(session('id_role')) {
        'R99' => app(DashboardController::class)->index(),
        'R01' => redirect('/pcm/membership'),
        'R03' => redirect('/prm/membership'),
        'R02' => redirect('/masjid/informasi'),
        default => abort(403, 'Akun tidak memiliki akses.')
    };
});

// ── SUPERADMIN (R99) ──
Route::prefix('superadmin')->group(function () {
    Route::get('/status-cabang',  fn() => session('id_role') == 'R99' ? view('superadmin.status-cabang')  : redirect('/dashboard'));
    Route::get('/status-ranting', fn() => session('id_role') == 'R99' ? view('superadmin.status-ranting') : redirect('/dashboard'));
    Route::get('/status-masjid',  fn() => session('id_role') == 'R99' ? view('superadmin.status-masjid')  : redirect('/dashboard'));
    Route::get('/approval-queue', fn() => session('id_role') == 'R99' ? view('superadmin.approval-queue') : redirect('/dashboard'));
    Route::get('/persetujuan',    fn() => session('id_role') == 'R99' ? view('superadmin.persetujuan')    : redirect('/dashboard'));

    Route::get('/akun-admin',                        [AkunAdminController::class, 'index']);
    Route::post('/akun-admin',                       [AkunAdminController::class, 'store']);
    Route::post('/akun-admin/{id}/toggle-status',    [AkunAdminController::class, 'toggleStatus']);
    Route::post('/akun-admin/{id}/reset-password',   [AkunAdminController::class, 'resetPassword']);
});

// ── ADMIN CABANG / PCM (R01) ──
Route::prefix('pcm')->group(function () {
    Route::get('/membership',    fn() => session('id_role') == 'R01' ? view('admin_cabang.membership')      : redirect('/dashboard'));
    Route::get('/sub-branches',  fn() => session('id_role') == 'R01' ? view('admin_cabang.data-masjid')     : redirect('/dashboard'));
    Route::get('/legal-status',  fn() => session('id_role') == 'R01' ? view('admin_cabang.legalitas-masjid'): redirect('/dashboard'));
    Route::get('/ranting-status',fn() => session('id_role') == 'R01' ? view('admin_cabang.status-ranting')  : redirect('/dashboard'));
    Route::get('/settings',      fn() => session('id_role') == 'R01' ? view('admin_cabang.settings')        : redirect('/dashboard'));

    // Persetujuan dari admin cabang
    Route::get('/persetujuan',                          [PersetujuanController::class, 'index']);
    Route::post('/persetujuan/{id}/approve',            [PersetujuanController::class, 'approve']);
    Route::post('/persetujuan/{id}/reject',             [PersetujuanController::class, 'reject']);
});

// ── ADMIN RANTING / PRM (R03) ──
Route::prefix('prm')->group(function () {
    Route::get('/membership',    fn() => session('id_role') == 'R03' ? view('admin_ranting.membership')      : redirect('/dashboard'));
    Route::get('/data-masjid',   fn() => session('id_role') == 'R03' ? view('admin_ranting.data-masjid')     : redirect('/dashboard'));
    Route::get('/legalitas',     fn() => session('id_role') == 'R03' ? view('admin_ranting.legalitas-masjid'): redirect('/dashboard'));
    Route::get('/status-ranting',fn() => session('id_role') == 'R03' ? view('admin_ranting.status-ranting')  : redirect('/dashboard'));
    Route::get('/settings',      fn() => session('id_role') == 'R03' ? view('admin_ranting.settings')        : redirect('/dashboard'));

    // CRUD Masjid oleh Admin Ranting
    Route::get('/tambah-masjid',     [MasjidController::class, 'create']);
    Route::post('/tambah-masjid',    [MasjidController::class, 'store']);
    Route::get('/edit-masjid/{id}',  [MasjidController::class, 'edit']);
    Route::put('/edit-masjid/{id}',  [MasjidController::class, 'update']);
});

// ── PENGURUS MASJID (R02) ──
Route::prefix('masjid')->group(function () {
    Route::get('/informasi', fn() => session('id_role') == 'R02' ? view('pengurus_masjid.Informasi') : redirect('/dashboard'));
    Route::get('/settings',  fn() => session('id_role') == 'R02' ? view('pengurus_masjid.Settings')  : redirect('/dashboard'));

    // Inventaris
    Route::get('/inventaris',           [InventarisController::class, 'index']);
    Route::post('/inventaris',          [InventarisController::class, 'store']);
    Route::put('/inventaris/{id}',      [InventarisController::class, 'update']);
    Route::delete('/inventaris/{id}',   [InventarisController::class, 'destroy']);

    // Takmir
    Route::get('/takmir',               [TakmirController::class, 'index']);
    Route::post('/takmir',              [TakmirController::class, 'store']);
    Route::put('/takmir/{id}',          [TakmirController::class, 'update']);
    Route::delete('/takmir/{id}',       [TakmirController::class, 'destroy']);

    // Legalitas
    Route::get('/legalitas',            [LegalitasController::class, 'index']);
    Route::post('/legalitas',           [LegalitasController::class, 'store']);
    Route::put('/legalitas/{id}',       [LegalitasController::class, 'update']);

    // Pengajuan
    Route::get('/pengajuan',            [PengajuanController::class, 'index']);
    Route::post('/pengajuan',           [PengajuanController::class, 'store']);
});