<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AkunAdminController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', function () {
    if (session('is_logged_in')) return redirect('/dashboard');
    return view('login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    if (!session('is_logged_in')) {
        return redirect('/login')->withErrors(['loginError' => 'Login dulu']);
    }

    $total_user       = DB::table('user')->count();
    $total_cabang     = DB::table('cabang')->where('status_keaktifan_cabang', 'Aktif')->count();
    $total_ranting    = DB::table('ranting')->where('status_keaktifan_ranting', 'Aktif')->count();
    $total_masjid     = DB::table('masjid')->count();
    $masjid_terdaftar = DB::table('masjid')->where('status_legalitas', 'Terdaftar')->count();

    if (session('id_role') == 'R99') {
        return view('superadmin.dashboard', compact(
            'total_user', 'total_cabang', 'total_ranting',
            'total_masjid', 'masjid_terdaftar'
        ));
    } elseif (session('id_role') == 'R01') {
        return view('admin_cabang.membership', compact('total_ranting', 'total_masjid'));
    } elseif (session('id_role') == 'R03') {
        return view('admin_ranting.membership');
    } elseif (session('id_role') == 'R02') {
        return redirect('/masjid/informasi');
    }

    return 'Maaf, akun Anda tidak memiliki akses.';
});

Route::get('/superadmin/persetujuan', function () {
    if (session('id_role') != 'R99') return redirect('/dashboard');
    return view('superadmin.persetujuan');
});

// --- RUTE ADMIN CABANG (PCM) — satu group, tidak dobel ---
Route::prefix('pcm')->group(function () {

    $guardPCM = function () {
        if (!session('is_logged_in'))
            return redirect('/login')->withErrors(['loginError' => 'Login dulu']);
        if (session('id_role') != 'R01')
            return redirect('/dashboard');
        return null;
    };

    Route::get('/membership', function () use ($guardPCM) {
        if ($redirect = $guardPCM()) return $redirect;
        return view('admin_cabang.membership');
    });

    Route::get('/sub-branches', function () use ($guardPCM) {
        if ($redirect = $guardPCM()) return $redirect;
        return view('admin_cabang.data-masjid');
    });

    Route::get('/legal-status', function () use ($guardPCM) {
    if ($redirect = $guardPCM()) return $redirect;
    return view('admin_cabang.legalitas-masjid'); // ← ganti
});

    Route::get('/ranting-status', function () use ($guardPCM) {
        if ($redirect = $guardPCM()) return $redirect;
        return view('admin_cabang.status-ranting'); // ← nama file yang ada
    });

    Route::get('/settings', function () use ($guardPCM) {
    if ($redirect = $guardPCM()) return $redirect;
    return view('admin_cabang.settings');
});
    
});

// --- RUTE ADMIN RANTING (PRM) ---
Route::prefix('prm')->group(function () {

    $guardPRM = function () {
        if (!session('is_logged_in'))
            return redirect('/login')->withErrors(['loginError' => 'Login dulu']);
        if (session('id_role') != 'R03')
            return redirect('/dashboard');
        return null;
    };

    Route::get('/membership', function () use ($guardPRM) {
        if ($redirect = $guardPRM()) return $redirect;
        return view('admin_ranting.membership');
    });

    Route::get('/data-masjid', function () use ($guardPRM) {
        if ($redirect = $guardPRM()) return $redirect;
        return view('admin_ranting.data-masjid');
    });

    Route::get('/legalitas', function () use ($guardPRM) {
        if ($redirect = $guardPRM()) return $redirect;
        return view('admin_ranting.legalitas-masjid');
    });

    Route::get('/status-ranting', function () use ($guardPRM) {
        if ($redirect = $guardPRM()) return $redirect;
        return view('admin_ranting.status-ranting');
    });

    Route::get('/settings', function () use ($guardPRM) {
        if ($redirect = $guardPRM()) return $redirect;
        return view('admin_ranting.settings');
    });

});

// --- RUTE PENGURUS MASJID ---
Route::prefix('masjid')->group(function () {

    $guardMasjid = function () {
        if (!session('is_logged_in'))
            return redirect('/login')->withErrors(['loginError' => 'Login dulu']);
        if (session('id_role') != 'R02')
            return redirect('/dashboard');
        return null;
    };

    Route::get('/informasi', function () use ($guardMasjid) {
        if ($redirect = $guardMasjid()) return $redirect;
        return view('pengurus_masjid.informasi');
    });

    Route::get('/settings', function () use ($guardMasjid) {
        if ($redirect = $guardMasjid()) return $redirect;
        return view('pengurus_masjid.settings');
    });

});

// --- RUTE SUPERADMIN ---
Route::prefix('superadmin')->group(function () {

    $guardSA = function () {
        if (!session('is_logged_in'))
            return redirect('/login')->withErrors(['loginError' => 'Login dulu']);
        if (session('id_role') != 'R99')
            return redirect('/dashboard');
        return null;
    };

    Route::get('/status-cabang', function () use ($guardSA) {
        if ($redirect = $guardSA()) return $redirect;
        return view('superadmin.status-cabang');
    });

    Route::get('/status-ranting', function () use ($guardSA) {
        if ($redirect = $guardSA()) return $redirect;
        return view('superadmin.status-ranting');
    });

    Route::get('/status-masjid', function () use ($guardSA) {
        if ($redirect = $guardSA()) return $redirect;
        return view('superadmin.status-masjid');
    });

    Route::get('/approval-queue', function () use ($guardSA) {
        if ($redirect = $guardSA()) return $redirect;
        return view('superadmin.approval-queue');
    });

    Route::get('/akun-admin', [AkunAdminController::class, 'index']);
    Route::post('/akun-admin', [AkunAdminController::class, 'store']);
    Route::post('/akun-admin/{id}/toggle-status', [AkunAdminController::class, 'toggleStatus']);
    Route::post('/akun-admin/{id}/reset-password', [AkunAdminController::class, 'resetPassword']);

});