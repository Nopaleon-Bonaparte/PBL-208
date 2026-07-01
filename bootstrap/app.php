<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Alias middleware pembatas login berdasarkan IP (whitelist)
        $middleware->alias([
            'login.ip' => \App\Http\Middleware\RestrictLoginByIp::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {

        // ── Tangani penolakan akses database (MySQL error 1142: command denied) ──
        // Menampilkan halaman khusus "Akses Dihentikan oleh Database Server"
        // untuk mendemonstrasikan efek REVOKE/GRANT (hak akses client-server).
        $exceptions->render(function (QueryException $e, Request $request) {
            $sqlState = $e->errorInfo[0] ?? null;   // mis. '42000'
            $driverCode = $e->errorInfo[1] ?? null; // mis. 1142
            $pesan = $e->getMessage();

            $aksesDitolak = ($driverCode === 1142)
                || str_contains($pesan, 'command denied')
                || str_contains($pesan, 'Access denied');

            if ($aksesDitolak) {
                return response()->view('errors.db_access_denied', [
                    'judul' => 'Akses Anda telah dicabut',
                ], 403);
            }
        });

    })->create();
