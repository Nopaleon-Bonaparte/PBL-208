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
use App\Http\Controllers\SettingsController;

// ── Root ──
Route::get('/', fn() => redirect('/login'));

// ── Auth ──
Route::get('/login', function () {
    if (session('is_logged_in')) return redirect('/dashboard');
    return view('login');
})->name('login')->middleware('login.ip');
Route::post('/login', [AuthController::class, 'login'])->middleware('login.ip');
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

    // Manajemen Akun — buat akun, hapus akun
    Route::get('/akun-admin',                        [AkunAdminController::class, 'index']);
    Route::post('/akun-admin',                       [AkunAdminController::class, 'store']);
    Route::post('/akun-admin/{id}/delete',           [AkunAdminController::class, 'destroy']);
    Route::get('/settings',                          [SettingsController::class, 'superadminIndex']);
});

Route::post('/settings/save', [SettingsController::class, 'save'])->name('settings.save');

// ── ADMIN CABANG / PCM (R01) ──
Route::prefix('pcm')->group(function () {
    Route::get('/membership', function () {
        if (session('id_role') != 'R01') return redirect('/dashboard');

        $idCabang   = session('id_cabang');
        $rantingIds = DB::table('ranting')->where('id_cabang', $idCabang)->pluck('id_ranting')->all();

        // Statistik ringkasan
        $totalMasjid  = DB::table('masjid')->whereIn('id_ranting', $rantingIds)->where('status_data','approved')->count();
        $masjidWakaf  = DB::table('masjid')->whereIn('id_ranting', $rantingIds)->where('status_data','approved')->where('status_tanah','Tanah Wakaf')->count();
        $totalRanting = count($rantingIds);
        $totalPending = DB::table('pengajuan')
            ->join('masjid','pengajuan.id_masjid','=','masjid.id_masjid')
            ->where('pengajuan.status','pending')
            ->whereIn('masjid.id_ranting', $rantingIds)
            ->count();

        // Antrian persetujuan (pending, terbaru)
        $antrian = DB::table('pengajuan')
            ->join('masjid','pengajuan.id_masjid','=','masjid.id_masjid')
            ->leftJoin('ranting','masjid.id_ranting','=','ranting.id_ranting')
            ->where('pengajuan.status','pending')
            ->whereIn('masjid.id_ranting', $rantingIds)
            ->select('pengajuan.id_pengajuan','pengajuan.jenis_pengajuan','pengajuan.created_at',
                     'masjid.nama_masjid','ranting.nama_ranting')
            ->orderBy('pengajuan.created_at','desc')
            ->limit(6)
            ->get();

        // Masjid baru terdaftar (approved, terbaru)
        $masjidBaru = DB::table('masjid')
            ->leftJoin('ranting','masjid.id_ranting','=','ranting.id_ranting')
            ->where('masjid.status_data','approved')
            ->whereIn('masjid.id_ranting', $rantingIds)
            ->select('masjid.id_masjid','masjid.nama_masjid','masjid.tipe','masjid.kecamatan','ranting.nama_ranting')
            ->orderBy('masjid.id_masjid','desc')
            ->limit(6)
            ->get();

        return view('admin_cabang.membership', compact(
            'totalMasjid','masjidWakaf','totalRanting','totalPending','antrian','masjidBaru'
        ));
    });
    Route::get('/sub-branches',  fn() => redirect('/pcm/legal-status'));
    Route::get('/legal-status', function () {
        if (session('id_role') != 'R01') return redirect('/dashboard');

        $idCabang   = session('id_cabang');
        $rantingIds = DB::table('ranting')->where('id_cabang', $idCabang)->pluck('id_ranting')->all();

        // Data masjid yang sudah approved
        $daftarMasjid = DB::table('masjid')
            ->leftJoin('ranting','masjid.id_ranting','=','ranting.id_ranting')
            ->where('masjid.status_data','approved')
            ->whereIn('masjid.id_ranting', $rantingIds)
            ->select(
                'masjid.id_masjid','masjid.nama_masjid','masjid.tipe','masjid.alamat',
                'masjid.kecamatan','masjid.kelurahan','masjid.kapasitas as kapasitas_jamaah',
                'masjid.status_tanah as status_wakaf','masjid.no_sertifikat as nomor_sertifikat',
                'ranting.nama_ranting'
            )
            ->orderBy('masjid.nama_masjid')
            ->get()
            ->map(function($m) {
                // Hitung jumlah inventaris & takmir dari tabel terkait
                $m->jumlah_inventaris = DB::table('inventaris')->where('id_masjid',$m->id_masjid)->count();
                $m->jumlah_takmir     = DB::table('takmir')->where('id_masjid',$m->id_masjid)->count();
                $m->kelengkapan_data  = 100; // cabang hanya view, anggap data sudah lengkap jika approved
                return $m;
            });

        // Statistik ringkasan
        $totalMasjid       = $daftarMasjid->count();
        $totalJenisM       = $daftarMasjid->where('tipe','Masjid')->count();
        $totalJenisMu      = $daftarMasjid->where('tipe','Musholla')->count();
        $totalBelumLengkap = 0; // semua approved dianggap lengkap di sisi cabang

        return view('admin_cabang.legalitas-masjid', compact(
            'daftarMasjid','totalMasjid','totalJenisM','totalJenisMu','totalBelumLengkap'
        ));
    });
    Route::get('/ranting-status',fn() => session('id_role') == 'R01' ? view('admin_cabang.status-ranting')  : redirect('/dashboard'));
    Route::get('/settings',      [SettingsController::class, 'cabangIndex']);

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
    Route::get('/legalitas',     [DataMasjidController::class, 'legalitas']);
    Route::get('/status-ranting',fn() => session('id_role') == 'R03' ? view('admin_ranting.status-ranting')  : redirect('/dashboard'));
    Route::get('/settings',      [SettingsController::class, 'rantingIndex']);

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
    Route::get('/settings',  [SettingsController::class, 'masjidIndex']);

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

    // Simpan koordinat peta masjid
    Route::post('/simpan-koordinat', function (\Illuminate\Http\Request $req) {
        if (session('id_role') != 'R02') return response()->json(['ok' => false, 'msg' => 'Unauthorized'], 403);
        $req->validate(['lat' => 'required|numeric', 'lng' => 'required|numeric']);
        $id = session('id_masjid');
        if (!$id) return response()->json(['ok' => false, 'msg' => 'Masjid tidak ditemukan'], 404);
        DB::table('masjid')->where('id_masjid', $id)->update([
            'latitude'  => $req->lat,
            'longitude' => $req->lng,
        ]);
        return response()->json(['ok' => true]);
    });
});