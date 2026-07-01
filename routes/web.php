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
use App\Http\Controllers\DataMasjidController;
use App\Http\Controllers\StatusController;

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

// ── SUPERADMIN (R99) ── hanya melihat data jadi + kelola akun ──
Route::prefix('superadmin')->group(function () {
    Route::get('/status-cabang',  [StatusController::class, 'cabang']);
    Route::get('/status-ranting', [StatusController::class, 'ranting']);

    // Data masjid yang SUDAH JADI (read-only) dari seluruh cabang
    Route::get('/status-masjid',  [DataMasjidController::class, 'superadmin']);

    // Manajemen Akun — buat akun (termasuk untuk cabang/ranting baru), pantau keaktifan
    Route::get('/akun-admin',                        [AkunAdminController::class, 'index']);
    Route::post('/akun-admin',                       [AkunAdminController::class, 'store']);
    Route::post('/akun-admin/{id}/toggle-status',    [AkunAdminController::class, 'toggleStatus']);
    Route::post('/akun-admin/{id}/reset-password',   [AkunAdminController::class, 'resetPassword']);

    // Tambah cabang / ranting baru (hanya superadmin)
    Route::post('/cabang',  [AkunAdminController::class, 'storeCabang']);
    Route::post('/ranting', [AkunAdminController::class, 'storeRanting']);

    // Manajemen Hak Akses
    Route::get('/hak-akses', fn() => view('superadmin.hak-akses'));
    Route::post('/hak-akses/grant', [\App\Http\Controllers\HakAksesController::class, 'grant']);
    Route::post('/hak-akses/revoke', [\App\Http\Controllers\HakAksesController::class, 'revoke']);
});

// ── ADMIN CABANG / PCM (R01) ──
Route::prefix('pcm')->group(function () {
    Route::get('/membership',    fn() => session('id_role') == 'R01' ? view('admin_cabang.membership')      : redirect('/dashboard'));
    Route::get('/sub-branches',  [DataMasjidController::class, 'cabang']);
    Route::get('/legal-status',  fn() => session('id_role') == 'R01' ? view('admin_cabang.legalitas-masjid'): redirect('/dashboard'));
    Route::get('/ranting-status',fn() => session('id_role') == 'R01' ? view('admin_cabang.status-ranting')  : redirect('/dashboard'));
    Route::get('/settings',      fn() => session('id_role') == 'R01' ? view('admin_cabang.settings')        : redirect('/dashboard'));

    // Admin cabang dapat mengedit data masjid yang sudah ada (perubahan langsung diterapkan)
    Route::get('/edit-masjid/{id}',  [MasjidController::class, 'editCabang']);
    Route::put('/edit-masjid/{id}',  [MasjidController::class, 'updateCabang']);

    // Persetujuan dari admin cabang
    Route::get('/persetujuan',                          [PersetujuanController::class, 'index']);
    Route::post('/persetujuan/{id}/approve',            [PersetujuanController::class, 'approve']);
    Route::post('/persetujuan/{id}/reject',             [PersetujuanController::class, 'reject']);
});

// ── ADMIN RANTING / PRM (R03) ──
Route::prefix('prm')->group(function () {
    Route::get('/membership', function () {
        if (session('id_role') != 'R03') return redirect('/dashboard');
        $idRanting = session('id_ranting');

        $totalMasjid      = DB::table('masjid')->where('id_ranting', $idRanting)->where('status_data', 'approved')->count();
        $masjidWakaf      = DB::table('masjid')->where('id_ranting', $idRanting)->where('status_legalitas', 'Terdaftar')->where('status_data', 'approved')->count();
        $pengajuanPending = DB::table('pengajuan')->join('masjid', 'pengajuan.id_masjid', '=', 'masjid.id_masjid')->where('masjid.id_ranting', $idRanting)->where('pengajuan.status', 'pending')->count();

        $rantingRow   = DB::table('ranting')->where('id_ranting', $idRanting)->first();
        $jumlahRanting = $rantingRow ? DB::table('ranting')->where('id_cabang', $rantingRow->id_cabang)->count() : 0;

        $daftarPengajuan = DB::table('pengajuan')
            ->join('masjid', 'pengajuan.id_masjid', '=', 'masjid.id_masjid')
            ->where('masjid.id_ranting', $idRanting)
            ->select('pengajuan.*', 'masjid.nama_masjid')
            ->orderBy('pengajuan.created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin_ranting.membership', compact(
            'totalMasjid', 'masjidWakaf', 'pengajuanPending', 'jumlahRanting', 'daftarPengajuan'
        ));
    });
    Route::get('/data-masjid',   [DataMasjidController::class, 'ranting']);
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
    Route::get('/informasi', function() {
        if (session('id_role') != 'R02') return redirect('/dashboard');
        
        $id_masjid = session('id_masjid');
        if (!$id_masjid) {
            $id_masjid = DB::table('user_masjid')->where('id_user', session('id_user'))->value('id_masjid');
            if ($id_masjid) {
                session(['id_masjid' => $id_masjid]);
            }
        }
        
        $masjid = DB::table('masjid')
            ->leftJoin('ranting', 'masjid.id_ranting', '=', 'ranting.id_ranting')
            ->leftJoin('cabang', 'ranting.id_cabang', '=', 'cabang.id_cabang')
            ->where('masjid.id_masjid', $id_masjid)
            ->select('masjid.*', 'ranting.nama_ranting', 'cabang.nama_cabang')
            ->first();
            
        $inventaris = DB::table('inventaris')->where('id_masjid', $id_masjid)->orderBy('nama_barang')->get();
        $takmir = DB::table('takmir')->where('id_masjid', $id_masjid)->orderBy('nama')->get();
        $legalitas = DB::table('legalitas')->where('id_masjid', $id_masjid)->orderBy('jenis_sertifikat')->get();
        $pengajuan = DB::table('pengajuan')->where('id_masjid', $id_masjid)->orderBy('created_at', 'desc')->get();
        
        return view('pengurus_masjid.Informasi', compact('masjid', 'inventaris', 'takmir', 'legalitas', 'pengajuan'));
    });
    Route::get('/settings',  fn() => session('id_role') == 'R02' ? view('pengurus_masjid.Settings')  : redirect('/dashboard'));

    // Pengurus masjid mengedit data masjidnya → masuk antrian persetujuan cabang
    Route::get('/edit-masjid/{id}',  [MasjidController::class, 'edit']);
    Route::put('/edit-masjid/{id}',  [MasjidController::class, 'update']);

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