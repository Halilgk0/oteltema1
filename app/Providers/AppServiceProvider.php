<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Schema\Builder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Static call: the Schema facade would open a database connection on every request
        Builder::defaultStringLength(191);

        if (config('database.auto_setup') && !$this->app->runningInConsole()) {
            $this->app->booted(fn () => $this->setUpDatabaseOnce());
        }
    }

    /**
     * Migrate the database (and seed it while it has no users) once per
     * server instance. A file lock keeps parallel requests from racing.
     */
    private function setUpDatabaseOnce(): void
    {
        $marker = storage_path('framework/database-ready');

        if (file_exists($marker)) {
            return;
        }

        $lock = fopen(storage_path('framework/database-setup.lock'), 'c');
        flock($lock, LOCK_EX);

        try {
            if (file_exists($marker)) {
                return;
            }

            $sqliteFile = config('database.connections.sqlite.database');

            if (config('database.default') === 'sqlite' && !file_exists($sqliteFile)) {
                touch($sqliteFile);
            }

            Artisan::call('migrate', ['--force' => true]);

            if (User::count() === 0) {
                Artisan::call('db:seed', ['--force' => true]);
            }

            touch($marker);
        } finally {
            flock($lock, LOCK_UN);
            fclose($lock);
        }
    }
}
