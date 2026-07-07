<?php

namespace App\Providers;

use Nitro\Foundation\Providers\ServiceProvider;
use Nitro\Scheduling\Schedule;

/**
 * Application service provider. Register your app's bindings here in register(),
 * and run boot-time wiring in boot().
 */
class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->schedule($this->container->make(Schedule::class));
    }

    /**
     * Define scheduled tasks. Run them from system cron every minute:
     *   * * * * * cd /path/to/app && php nitro schedule:run
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            // e.g. prune stale records, send a daily digest, warm caches…
        })->daily()->description('Example daily maintenance task');
    }
}
