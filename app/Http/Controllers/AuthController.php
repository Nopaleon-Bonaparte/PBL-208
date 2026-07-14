<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Proses login.
     * Role TIDAK dipilih manual oleh user — otomatis diambil dari
     * kolom id_role pada tabel `user` sesuai username yang login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // ── Coba login via tabel user terlebih dahulu ──
        $user = DB::table('user')
            ->where('username', $request->username)
            ->first();

        // ── Jika tidak ditemukan di tabel user, coba tabel masjid (Takmir / Pengurus Masjid) ──
        if (!$user) {
            $masjid = DB::table('masjid')
                ->where('default_username', $request->username)
                ->where('status_data', 'approved')
                ->first();

            if (!$masjid) {
                return redirect('/login')->withErrors([
                    'loginError' => 'Username atau password salah.',
                ]);
            }

            // Validasi password takmir (plain text saat ini)
            $pwValid = false;
            if (\Illuminate\Support\Str::startsWith($masjid->default_password ?? '', '$2y$')) {
                $pwValid = Hash::check($request->password, $masjid->default_password);
            } else {
                $pwValid = $request->password === $masjid->default_password;
            }

            if (!$pwValid) {
                return redirect('/login')->withErrors([
                    'loginError' => 'Username atau password salah.',
                ]);
            }

            // ── Set session untuk takmir ──
            $request->session()->put('is_logged_in', true);
            $request->session()->put('id_role',    'R02');
            $request->session()->put('username',   $masjid->default_username);
            $request->session()->put('id_user',    'TAKMIR_' . $masjid->id_masjid);
            $request->session()->put('id_masjid',  $masjid->id_masjid);
            $request->session()->put('nama_masjid', $masjid->nama_masjid);
            $request->session()->put('id_ranting', $masjid->id_ranting);

            // Ambil nama ranting & cabang
            if ($masjid->id_ranting) {
                $ranting = DB::table('ranting')->where('id_ranting', $masjid->id_ranting)->first();
                if ($ranting) {
                    $request->session()->put('nama_ranting', $ranting->nama_ranting);
                    $cabang = DB::table('cabang')->where('id_cabang', $ranting->id_cabang)->first();
                    if ($cabang) {
                        $request->session()->put('id_cabang',   $cabang->id_cabang);
                        $request->session()->put('nama_cabang', $cabang->nama_cabang);
                    }
                }
            }

            $request->session()->regenerate();
            return redirect('/dashboard');
        }

        // ── Login normal via tabel user ──
        $passwordValid = false;
        if (\Illuminate\Support\Str::startsWith($user->password, '$2y$')) {
            $passwordValid = Hash::check($request->password, $user->password);
        } else {
            $passwordValid = $request->password === $user->password;
        }

        if (!$passwordValid) {
            return redirect('/login')->withErrors([
                'loginError' => 'Username atau password salah.',
            ]);
        }

        // ── Cek status akun (akun nonaktif tidak boleh login) ──
        if (isset($user->status_akun) && $user->status_akun === 'Nonaktif') {
            return redirect('/login')->withErrors([
                'loginError' => 'Akun Anda nonaktif. Hubungi administrator.',
            ]);
        }

        // ── Catat waktu login terakhir (untuk pemantauan keaktifan superadmin) ──
        DB::table('user')->where('id_user', $user->id_user)->update([
            'terakhir_login' => now(),
        ]);

        // ── Set session dasar ──
        $request->session()->put('is_logged_in', true);
        $request->session()->put('id_user', $user->id_user);
        $request->session()->put('username', $user->username);
        $request->session()->put('id_role', $user->id_role);
        $request->session()->put('id_ranting', $user->id_ranting);

        // ── Jika role = Pengurus Masjid (R02), ambil masjid yang dikelola ──
        if ($user->id_role === 'R02') {
            $masjid = DB::table('user_masjid')
                ->join('masjid', 'user_masjid.id_masjid', '=', 'masjid.id_masjid')
                ->where('user_masjid.id_user', $user->id_user)
                ->first();

            if ($masjid) {
                $request->session()->put('id_masjid', $masjid->id_masjid);
                $request->session()->put('nama_masjid', $masjid->nama_masjid);
            }
        }

        // ── Jika role = Admin Ranting / Admin Cabang, ambil nama ranting/cabang ──
        if ($user->id_ranting) {
            $ranting = DB::table('ranting')
                ->where('id_ranting', $user->id_ranting)
                ->first();

            if ($ranting) {
                $request->session()->put('nama_ranting', $ranting->nama_ranting);

                $cabang = DB::table('cabang')
                    ->where('id_cabang', $ranting->id_cabang)
                    ->first();

                if ($cabang) {
                    $request->session()->put('id_cabang', $cabang->id_cabang);
                    $request->session()->put('nama_cabang', $cabang->nama_cabang);
                }
            }
        } elseif ($user->id_cabang) {
            $cabang = DB::table('cabang')
                ->where('id_cabang', $user->id_cabang)
                ->first();

            if ($cabang) {
                $request->session()->put('id_cabang', $cabang->id_cabang);
                $request->session()->put('nama_cabang', $cabang->nama_cabang);
            }
        }

        // Regenerate session id untuk keamanan (cegah session fixation)
        $request->session()->regenerate();

        // Role-based redirect ditangani di route /dashboard (web.php)
        return redirect('/dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate();

        return redirect('/login')->with('success', 'Anda telah berhasil keluar dari sistem.');
    }
}