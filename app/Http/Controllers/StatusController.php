<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * StatusController — keaktifan berdasarkan aktivitas login (terakhir_login).
 *
 * Skor & status dihitung dari berapa hari sejak login terakhir akun:
 *   <= 14 hari  -> Aktif        (skor tinggi)
 *   <= 45 hari  -> Kurang Aktif
 *   > 45 / null -> Vakum
 *
 * Hanya untuk SUPERADMIN (R99) — view only, tidak bisa menambah.
 */
class StatusController extends Controller
{
    /** Hitung skor 0–100 dari jumlah hari sejak login. */
    private function hitung($lastLogin): array
    {
        if (!$lastLogin) {
            return ['hari' => null, 'skor' => 0, 'status' => 'Vakum', 'teks' => 'Belum pernah login'];
        }

        $hari = (int) Carbon::parse($lastLogin)->diffInDays(Carbon::now());

        // Skor menurun seiring lamanya tidak login (maks 90 hari -> 0).
        $skor = (int) max(0, min(100, round(100 - ($hari / 90 * 100))));

        if ($hari <= 14)      $status = 'Aktif';
        elseif ($hari <= 45)  $status = 'Kurang Aktif';
        else                  $status = 'Vakum';

        if ($hari === 0)       $teks = 'Hari ini';
        elseif ($hari === 1)   $teks = '1 hari lalu';
        else                   $teks = $hari . ' hari lalu';

        return ['hari' => $hari, 'skor' => $skor, 'status' => $status, 'teks' => $teks];
    }

    /** Status keaktifan seluruh RANTING (untuk superadmin). */
    public function ranting()
    {
        if (session('id_role') != 'R99') return redirect('/dashboard');

        $rows = DB::table('ranting')
            ->join('user', 'user.id_ranting', '=', 'ranting.id_ranting')
            ->select(
                'ranting.id_ranting',
                'ranting.nama_ranting',
                DB::raw('MAX(user.terakhir_login) as last_login')
            )
            ->groupBy('ranting.id_ranting', 'ranting.nama_ranting')
            ->orderBy('ranting.nama_ranting')
            ->get();

        $daftar = $rows->map(function ($r) {
            $h = $this->hitung($r->last_login);
            return (object) [
                'nama'             => $r->nama_ranting,
                'laporan_terakhir' => $h['teks'],
                'skor'             => $h['skor'],
                'status'           => $h['status'],
            ];
        });

        return view('superadmin.status-ranting', ['daftar' => $daftar]);
    }

    /** Status keaktifan seluruh CABANG (untuk superadmin). */
    public function cabang()
    {
        if (session('id_role') != 'R99') return redirect('/dashboard');

        // login terakhir per cabang = login terbaru semua user di ranting bawah cabang ATAU user admin cabang langsung.
        $rows = DB::table('cabang')
            ->leftJoin('ranting', 'ranting.id_cabang', '=', 'cabang.id_cabang')
            ->leftJoin('user as u_ranting', 'u_ranting.id_ranting', '=', 'ranting.id_ranting')
            ->leftJoin('user as u_cabang', 'u_cabang.id_cabang', '=', 'cabang.id_cabang')
            ->where(function ($q) {
                $q->whereNotNull('u_ranting.id_user')
                  ->orWhereNotNull('u_cabang.id_user');
            })
            ->select(
                'cabang.id_cabang',
                'cabang.nama_cabang',
                DB::raw('MAX(u_ranting.terakhir_login) as last_login_r'),
                DB::raw('MAX(u_cabang.terakhir_login) as last_login_c')
            )
            ->groupBy('cabang.id_cabang', 'cabang.nama_cabang')
            ->orderBy('cabang.nama_cabang')
            ->get();

        $daftar = $rows->map(function ($r) {
            $last_login = null;
            if ($r->last_login_r && $r->last_login_c) {
                $last_login = max($r->last_login_r, $r->last_login_c);
            } else {
                $last_login = $r->last_login_r ?: $r->last_login_c;
            }
            $h = $this->hitung($last_login);
            return (object) [
                'nama'             => $r->nama_cabang,
                'laporan_terakhir' => $h['teks'],
                'skor'             => $h['skor'],
                'status'           => $h['status'],
            ];
        });

        return view('superadmin.status-cabang', ['daftar' => $daftar]);
    }
}
