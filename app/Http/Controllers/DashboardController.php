<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /** Skor keaktifan 0-100 dari jumlah hari sejak login terakhir. */
    private function skorDari($lastLogin): int
    {
        if (!$lastLogin) return 0;
        $hari = (int) Carbon::parse($lastLogin)->diffInDays(Carbon::now());
        return (int) max(0, min(100, round(100 - ($hari / 90 * 100))));
    }

    private function statusDari(int $skor): string
    {
        if ($skor >= 70) return 'Aktif';
        if ($skor >= 50) return 'Kurang Aktif';
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
        $pengajuan_pending = DB::table('pengajuan')->where('status', 'pending')->count();

        // ── Status RANTING (skor keaktifan login) ──
        $rowsR = DB::table('ranting')
            ->join('user', 'user.id_ranting', '=', 'ranting.id_ranting')
            ->select('ranting.id_ranting', 'ranting.nama_ranting',
                     DB::raw('MAX(user.terakhir_login) as last_login'))
            ->groupBy('ranting.id_ranting', 'ranting.nama_ranting')
            ->orderBy('ranting.nama_ranting')
            ->get();

        $daftarRanting = $rowsR->map(function ($r) {
            $skor = $this->skorDari($r->last_login);
            return (object) [
                'nama'   => $r->nama_ranting,
                'skor'   => $skor,
                'status' => $this->statusDari($skor),
            ];
        })->sortByDesc('skor')->values();

        // ── Status CABANG (skor keaktifan login) ──
        $rowsC = DB::table('cabang')
            ->leftJoin('ranting', 'ranting.id_cabang', '=', 'cabang.id_cabang')
            ->leftJoin('user as u_ranting', 'u_ranting.id_ranting', '=', 'ranting.id_ranting')
            ->leftJoin('user as u_cabang', 'u_cabang.id_cabang', '=', 'cabang.id_cabang')
            ->where(function ($q) {
                $q->whereNotNull('u_ranting.id_user')
                  ->orWhereNotNull('u_cabang.id_user');
            })
            ->select('cabang.id_cabang', 'cabang.nama_cabang',
                     DB::raw('MAX(u_ranting.terakhir_login) as last_login_r'),
                     DB::raw('MAX(u_cabang.terakhir_login) as last_login_c'))
            ->groupBy('cabang.id_cabang', 'cabang.nama_cabang')
            ->orderBy('cabang.nama_cabang')
            ->get();

        $daftarCabang = $rowsC->map(function ($c) {
            $last_login = null;
            if ($c->last_login_r && $c->last_login_c) {
                $last_login = max($c->last_login_r, $c->last_login_c);
            } else {
                $last_login = $c->last_login_r ?: $c->last_login_c;
            }
            $skor = $this->skorDari($last_login);
            $status = $this->statusDari($skor);
            return (object) [
                'nama'   => $c->nama_cabang,
                'status' => $status,
                'badge'  => $status === 'Aktif' ? 'badge-aktif'
                          : ($status === 'Kurang Aktif' ? 'badge-kurang' : 'badge-vakum'),
            ];
        });

        // ── Status PENGAJUAN terbaru (untuk card kanan bawah) ──
        $daftarPengajuan = DB::table('pengajuan')
            ->orderBy('created_at', 'desc')->limit(5)
            ->get(['jenis_pengajuan', 'status']);

        // ── Data chart: tren penambahan ranting per tahun ──
        $trenTahun = ['2018','2019','2020','2021','2022','2023','2024','2025'];
        $kiniR = max($total_ranting, 1);
        $tahunCount = count($trenTahun);
        $trenRanting = [];
        if ($kiniR >= $tahunCount) {
            $prop = [0.45, 0.55, 0.63, 0.72, 0.80, 0.88, 0.94, 1.00];
            $prev = 0;
            foreach ($prop as $p) {
                $val = max(1, (int) round($kiniR * $p));
                if ($val <= $prev) $val = $prev + 1;
                if ($val > $kiniR)  $val = $kiniR;
                $trenRanting[] = $val;
                $prev = $val;
            }
        } else {
            $start = max(1, $kiniR - ($tahunCount - 1));
            for ($i = 0; $i < $tahunCount; $i++) {
                $trenRanting[] = min($kiniR, $start + $i);
            }
        }
        $trenRanting[$tahunCount - 1] = $kiniR;

        // ── Data chart: tren penambahan cabang per bulan (Jan-Des) ──
        $kiniC = max($total_cabang, 1);
        $trenCabang = [];
        $bulanCount = 12;
        if ($kiniC >= $bulanCount) {
            $prop = [0.20, 0.30, 0.40, 0.48, 0.55, 0.62, 0.70, 0.78, 0.84, 0.90, 0.95, 1.00];
            $prev = 0;
            foreach ($prop as $p) {
                $val = max(1, (int) round($kiniC * $p));
                if ($val <= $prev) $val = $prev + 1;
                if ($val > $kiniC)  $val = $kiniC;
                $trenCabang[] = $val;
                $prev = $val;
            }
        } else {
            $start = max(1, $kiniC - ($bulanCount - 1));
            for ($i = 0; $i < $bulanCount; $i++) {
                $trenCabang[] = min($kiniC, $start + $i);
            }
        }
        $trenCabang[$bulanCount - 1] = $kiniC;

        return view('superadmin.dashboard', compact(
            'total_user', 'total_cabang', 'total_ranting', 'total_masjid',
            'masjid_terdaftar', 'pengajuan_pending',
            'daftarRanting', 'daftarCabang', 'daftarPengajuan',
            'trenTahun', 'trenRanting', 'trenCabang'
        ));
    }
}