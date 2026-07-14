<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    private function getCurrentUser()
    {
        return DB::table('user')
            ->where('id_user', session('id_user'))
            ->first();
    }

    public function superadminIndex()
    {
        if (session('id_role') !== 'R99') return redirect('/dashboard');
        $user = $this->getCurrentUser();
        return view('superadmin.settings', compact('user'));
    }

    public function cabangIndex()
    {
        if (session('id_role') !== 'R01') return redirect('/dashboard');
        $user = $this->getCurrentUser();
        return view('admin_cabang.settings', compact('user'));
    }

    public function rantingIndex()
    {
        if (session('id_role') !== 'R03') return redirect('/dashboard');
        $user = $this->getCurrentUser();
        return view('admin_ranting.settings', compact('user'));
    }

    public function masjidIndex()
    {
        if (session('id_role') !== 'R02') return redirect('/dashboard');
        $user = $this->getCurrentUser();
        return view('pengurus_masjid.Settings', compact('user'));
    }

    public function save(Request $request)
    {
        if (!session('is_logged_in')) return redirect('/login');

        $userId = session('id_user');

        $request->validate([
            'nama_lengkap' => 'required|string|max:150',
            'username'     => 'required|string|max:100|unique:user,username,' . $userId . ',id_user',
            'email'        => 'nullable|email|max:150',
            'no_hp'        => 'nullable|string|max:20',
            'password'     => 'nullable|string|min:6|confirmed',
        ]);

        $updateData = [
            'nama_lengkap' => $request->nama_lengkap,
            'username'     => $request->username,
            'email'        => $request->email,
            'no_hp'        => $request->no_hp,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = $request->password;
        }

        DB::table('user')->where('id_user', $userId)->update($updateData);

        // Update Session
        session([
            'nama_lengkap' => $request->nama_lengkap,
            'username'     => $request->username,
            'email'        => $request->email,
            'phone'        => $request->no_hp
        ]);

        return back()->with('success', 'Pengaturan akun berhasil disimpan.');
    }
}
