<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // 1. Validasi inputan tidak boleh kosong
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'id_role' => 'required'
        ]);

        // 2. Cari data di database yang cocok persis ketiganya
        $user = DB::table('user')
                    ->where('username', $request->username)
                    ->where('password', $request->password)
                    ->where('id_role', $request->id_role)
                    ->first();

        // 3. Kalau datanya valid
        if ($user) {
            // Buat tiket sesi
            session([
                'is_logged_in' => true,
                'id_user' => $user->id_user,
                'id_role' => $user->id_role,
                'username' => $user->username
            ]);

            // Lempar ke dashboard
            return redirect('/dashboard');
        }

        // 4. Kalau gagal login
        return back()->withErrors(['loginError' => 'Username, Kata Sandi, atau Role tidak cocok!']);
    }

    public function logout(Request $request)
    {
        // Hapus semua tiket sesi
        $request->session()->flush();
        // Lempar balik ke halaman login
        return redirect('/login');
    }
}
