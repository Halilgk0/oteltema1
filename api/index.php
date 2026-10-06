<?php

/*
|--------------------------------------------------------------------------
| Vercel Serverless Entry Point
|--------------------------------------------------------------------------
|
| Vercel runs PHP through the vercel-php runtime (see vercel.json) and every
| request is routed here. The deployed code is read-only and only the temp
| directory is writable, so everything Laravel writes at runtime (compiled
| views, caches, the demo SQLite database) is pointed there. Values already
| set in the Vercel project's environment variables take precedence.
|
*/

$tmp = sys_get_temp_dir() . '/laravel';

$defaults = [
    'APP_ENV' => 'production',
    'APP_DEBUG' => 'false',
    'APP_STORAGE_PATH' => "{$tmp}/storage",
    'APP_CONFIG_CACHE' => "{$tmp}/cache/config.php",
    'APP_EVENTS_CACHE' => "{$tmp}/cache/events.php",
    'APP_PACKAGES_CACHE' => "{$tmp}/cache/packages.php",
    'APP_ROUTES_CACHE' => "{$tmp}/cache/routes.php",
    'APP_SERVICES_CACHE' => "{$tmp}/cache/services.php",
    'VIEW_COMPILED_PATH' => "{$tmp}/storage/framework/views",
    'LOG_CHANNEL' => 'stderr',
    'SESSION_DRIVER' => 'cookie',
    'SESSION_SECURE_COOKIE' => 'true',
    'CACHE_DRIVER' => 'file',
    // Vercel replaces X-Forwarded-* with the real client values, so they can be trusted
    'TRUSTED_PROXIES' => '*',
    // Demo database: a fresh SQLite file per server instance, migrated and seeded on first use
    'DB_CONNECTION' => 'sqlite',
    'DB_DATABASE' => "{$tmp}/database.sqlite",
    'DB_AUTO_SETUP' => 'true',
];

foreach ($defaults as $key => $value) {
    if (getenv($key) === false && !isset($_ENV[$key]) && !isset($_SERVER[$key])) {
        putenv("{$key}={$value}");
        $_ENV[$key] = $_SERVER[$key] = $value;
    }
}

foreach (['cache', 'storage/app/public', 'storage/framework/cache/data', 'storage/framework/views', 'storage/logs'] as $dir) {
    if (!is_dir("{$tmp}/{$dir}")) {
        @mkdir("{$tmp}/{$dir}", 0755, true);
    }
}

require __DIR__ . '/../public/index.php';
