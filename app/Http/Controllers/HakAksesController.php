<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HakAksesController extends Controller
{
    public function grant(Request $request)
    {
        if (session('id_role') != 'R99') {
            return redirect('/dashboard');
        }

        $request->validate([
            'role_id' => 'required',
            'role_user' => 'required',
            'role_label' => 'required',
            'privilege' => 'required',
            'table' => 'required',
        ]);

        try {
            $user = $request->role_user;
            $privilege = $request->privilege;
            $table = $request->table;
            $role_id = $request->role_id; // e.g., R01, R02, R03
            $role_label = $request->role_label;

            // Execute SQL GRANT
            DB::statement("GRANT {$privilege} ON {$table} TO '{$user}'@'localhost'");
            DB::statement("FLUSH PRIVILEGES");

            // Log notification for the targeted role
            DB::table('privilege_notifications')->insert([
                'id_role' => $role_id,
                'type' => 'grant',
                'message' => "Hak akses {$privilege} pada tabel {$table} telah diberikan kepada peran Anda.",
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Add log message for Superadmin
            $logMsg = [
                'ts' => now()->format('H:i:s'),
                'type' => 'grant',
                'msg' => "[GRANT] Hak akses {$privilege} pada {$table} berhasil diberikan kepada {$role_label} ({$user}@localhost)."
            ];
            
            $priv_log = session('priv_log', []);
            $priv_log[] = $logMsg;
            if (count($priv_log) > 10) array_shift($priv_log);
            Session::put('priv_log', $priv_log);

            return back()->with('priv_success', "Privilege {$privilege} diberikan kepada {$role_label} pada {$table}.");

        } catch (\Exception $e) {
            return back()->with('priv_error', "Gagal menjalankan GRANT: " . $e->getMessage());
        }
    }

    public function revoke(Request $request)
    {
        if (session('id_role') != 'R99') {
            return redirect('/dashboard');
        }

        $request->validate([
            'role_id' => 'required',
            'role_user' => 'required',
            'role_label' => 'required',
            'privilege' => 'required',
            'table' => 'required',
        ]);

        try {
            $user = $request->role_user;
            $privilege = $request->privilege;
            $table = $request->table;
            $role_id = $request->role_id;
            $role_label = $request->role_label;

            // Execute SQL REVOKE
            DB::statement("REVOKE {$privilege} ON {$table} FROM '{$user}'@'localhost'");
            DB::statement("FLUSH PRIVILEGES");

            // Log notification for the targeted role
            DB::table('privilege_notifications')->insert([
                'id_role' => $role_id,
                'type' => 'revoke',
                'message' => "Hak akses {$privilege} pada tabel {$table} telah DICABUT dari peran Anda.",
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Add log message for Superadmin
            $logMsg = [
                'ts' => now()->format('H:i:s'),
                'type' => 'revoke',
                'msg' => "[REVOKE] Hak akses {$privilege} pada {$table} telah dicabut dari {$role_label} ({$user}@localhost)."
            ];
            
            $priv_log = session('priv_log', []);
            $priv_log[] = $logMsg;
            if (count($priv_log) > 10) array_shift($priv_log);
            Session::put('priv_log', $priv_log);

            return back()->with('priv_success', "Privilege {$privilege} dicabut dari {$role_label} pada {$table}.");

        } catch (\Exception $e) {
            return back()->with('priv_error', "Gagal menjalankan REVOKE: " . $e->getMessage());
        }
    }
}
