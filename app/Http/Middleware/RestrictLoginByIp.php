<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RestrictLoginByIp
{
    public function handle(Request $request, Closure $next): Response
    {
        $whitelist = config('ipwhitelist.login', []);
 
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

        abort(403, 'Akses login tidak diizinkan dari perangkat ini (IP: ' . $clientIp . ').');
    }

    private function cocok(string $ip, string $rule): bool
    {
        if ($ip === $rule) {
            return true;
        }
        if (str_contains($rule, '*')) {
            $pattern = '/^' . str_replace(['.', '*'], ['\.', '\d{1,3}'], $rule) . '$/';
            return (bool) preg_match($pattern, $ip);
        }
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
