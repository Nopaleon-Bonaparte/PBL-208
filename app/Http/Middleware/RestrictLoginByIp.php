<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * RestrictLoginByIp
 *
 * Membatasi akses halaman login hanya dari IP yang terdaftar (whitelist).
 * Daftar IP diambil dari config/ipwhitelist.php (bersumber dari .env).
 *
 * Cara pakai: pasang middleware ini pada route login (lihat CARA-PASANG.md).
 *
 * Fitur:
 *  - Whitelist kosong  -> akses diizinkan (mode nonaktif, aman saat lupa mengisi).
 *  - Mendukung IP tunggal (mis. 192.168.1.10).
 *  - Mendukung wildcard sederhana (mis. 192.168.1.*) untuk satu subnet.
 *  - Mendukung notasi CIDR (mis. 192.168.1.0/24).
 */
class RestrictLoginByIp
{
    public function handle(Request $request, Closure $next): Response
    {
        $whitelist = config('ipwhitelist.login', []);

        // Jika whitelist kosong, fitur dianggap NONAKTIF -> izinkan semua.
        if (empty($whitelist)) {
            return $next($request);
        }

        $clientIp = $request->ip();

        foreach ($whitelist as $allowed) {
            $allowed = trim($allowed);
            if ($allowed === '') {
                continue;
            }
            if ($this->cocok($clientIp, $allowed)) {
                return $next($request);
            }
        }

        // IP tidak terdaftar -> tolak akses.
        abort(403, 'Akses login tidak diizinkan dari perangkat ini (IP: ' . $clientIp . ').');
    }

    /**
     * Cek apakah $ip cocok dengan aturan $rule.
     * Mendukung: IP persis, wildcard (*), dan CIDR (x.x.x.x/n).
     */
    private function cocok(string $ip, string $rule): bool
    {
        // 1. IP persis
        if ($ip === $rule) {
            return true;
        }

        // 2. Wildcard: 192.168.1.*
        if (str_contains($rule, '*')) {
            $pattern = '/^' . str_replace(['.', '*'], ['\.', '\d{1,3}'], $rule) . '$/';
            return (bool) preg_match($pattern, $ip);
        }

        // 3. CIDR: 192.168.1.0/24 (hanya IPv4)
        if (str_contains($rule, '/') && filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            [$subnet, $bits] = explode('/', $rule);
            if (!filter_var($subnet, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                return false;
            }
            $ipLong     = ip2long($ip);
            $subnetLong = ip2long($subnet);
            $mask       = -1 << (32 - (int) $bits);
            return ($ipLong & $mask) === ($subnetLong & $mask);
        }

        return false;
    }
}
