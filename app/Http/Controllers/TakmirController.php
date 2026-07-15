<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TakmirController extends Controller
{
    private function guard()
    {
        return session('id_role') == 'R02' && session('id_masjid');
    }

    private function nextId(): string
    {
        $c = DB::table('takmir')->count() + 1;
        return 'TKM' . str_pad((string) $c, 4, '0', STR_PAD_LEFT);
    }

    public function index()
    {
        if (!$this->guard()) return redirect('/dashboard');

        $items = DB::table('takmir')
            ->where('id_masjid', session('id_masjid'))
            ->orderBy('nama')->get();

        return response()->json($items);
    }

    public function store(Request $request)
    {
        if (!$this->guard()) return redirect('/dashboard');

        $request->validate([
            'nama'    => 'required|string|max:100',
            'jabatan' => 'required|string|max:50',
            'no_hp'   => 'nullable|string|max:15',
            'masa_jabatan_mulai'   => 'nullable|date',
            'masa_jabatan_selesai' => 'nullable|date',
        ]);

        DB::table('takmir')->insert([
            'id_takmir'            => $this->nextId(),
            'id_masjid'            => session('id_masjid'),
            'nama'                 => $request->nama,
            'jabatan'              => $request->jabatan,
            'no_hp'                => $request->no_hp,
            'masa_jabatan_mulai'   => $request->masa_jabatan_mulai,
            'masa_jabatan_selesai' => $request->masa_jabatan_selesai,
            'created_at'           => now(),
            'updated_at'           => now(),
        ]);

        return back()->with('success', 'Takmir ditambahkan.');
    }

    public function update(Request $request, string $id)
    {
        if (!$this->guard()) return redirect('/dashboard');

        $request->validate([
            'nama'    => 'required|string|max:100',
            'jabatan' => 'required|string|max:50',
            'no_hp'   => 'nullable|string|max:15',
        ]);

        DB::table('takmir')
            ->where('id_takmir', $id)
            ->where('id_masjid', session('id_masjid'))
            ->update([
                'nama'       => $request->nama,
                'jabatan'    => $request->jabatan,
                'no_hp'      => $request->no_hp,
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Takmir diperbarui.');
    }

    public function destroy(string $id)
    {
        if (!$this->guard()) return redirect('/dashboard');

        DB::table('takmir')
            ->where('id_takmir', $id)
            ->where('id_masjid', session('id_masjid'))
            ->delete();

        return back()->with('success', 'Takmir dihapus.');
    }
}
