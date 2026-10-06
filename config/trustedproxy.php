<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Trusted Proxies
    |--------------------------------------------------------------------------
    |
    | Read by App\Http\Middleware\TrustProxies. Behind a proxy that rewrites
    | X-Forwarded-* headers (e.g. Vercel) set this to "*" so Laravel sees the
    | real client IP and HTTPS scheme. Leave it empty when there is no proxy,
    | otherwise clients could spoof their IP and dodge the rate limits.
    |
    */

    'proxies' => env('TRUSTED_PROXIES'),

];
