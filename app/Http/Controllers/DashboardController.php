<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /** Hitung status keaktifan dari jumlah hari sejak login terakhir. */
    private function statusDari($lastLogin): string
    {
        if (!$lastLogin) return 'Vakum';
        $hari = Carbon::parse($lastLogin)->diffInDays(Carbon::now());
        if ($hari <= 14) return 'Aktif';
        if ($hari <= 45) return 'Kurang Aktif';
        return 'Vakum';
    }

    public function index()
    {
        // ── Statistik umum ──
        $total_user   = DB::table('user')->count();
        $total_cabang = DB::table('cabang')->where('status_keaktifan_cabang', 'Aktif')->count();
        $total_ranting= DB::table('ranting')->where('status_keaktifan_ranting', 'Aktif')->count();
        $total_masjid = DB::table('masjid')->count();
        $masjid_terdaftar = DB::table('masjid')->where('status_legalitas', 'Terdaftar')->count();

        // ── Status RANTING berbasis keaktifan login ──
        $rows = DB::table('ranting')
            ->leftJoin('user', 'user.id_ranting', '=', 'ranting.id_ranting')
            ->select('ranting.id_ranting', 'ranting.nama_ranting',
                     DB::raw('MAX(user.terakhir_login) as last_login'))
            ->groupBy('ranting.id_ranting', 'ranting.nama_ranting')
            ->orderBy('ranting.nama_ranting')
            ->get();

        $daftarRanting = $rows->map(function ($r) {
            $status = $this->statusDari($r->last_login);
            return (object) [
                'nama'   => $r->nama_ranting,
                'status' => $status,
                'badge'  => $status === 'Aktif' ? 'badge-aktif'
                          : ($status === 'Kurang Aktif' ? 'badge-kurang' : 'badge-vakum'),
            ];
        });

        // ── Hitung statistik untuk kartu visual ──
        $rantingAktif  = $daftarRanting->where('status', 'Aktif')->count();
        $rantingKurang = $daftarRanting->where('status', 'Kurang Aktif')->count();
        $rantingVakum  = $daftarRanting->where('status', 'Vakum')->count();

        // ── Status CABANG berbasis keaktifan login ──
        $rowsC = DB::table('cabang')
            ->leftJoin('ranting', 'ranting.id_cabang', '=', 'cabang.id_cabang')
            ->leftJoin('user', 'user.id_ranting', '=', 'ranting.id_ranting')
            ->select('cabang.id_cabang', 'cabang.nama_cabang',
                     DB::raw('MAX(user.terakhir_login) as last_login'))
            ->groupBy('cabang.id_cabang', 'cabang.nama_cabang')
            ->orderBy('cabang.nama_cabang')
            ->get();

        $daftarCabang = $rowsC->map(function ($c) {
            $status = $this->statusDari($c->last_login);
            return (object) [
                'nama'   => $c->nama_cabang,
                'status' => $status,
                'badge'  => $status === 'Aktif' ? 'badge-aktif'
                          : ($status === 'Kurang Aktif' ? 'badge-kurang' : 'badge-vakum'),
            ];
        });

        return view('superadmin.dashboard', compact(
            'total_user', 'total_cabang', 'total_ranting', 'total_masjid', 'masjid_terdaftar',
            'daftarRanting', 'rantingAktif', 'rantingKurang', 'rantingVakum', 'daftarCabang'
        ));
    }
}
