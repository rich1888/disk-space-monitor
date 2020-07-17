<?php

namespace Rich1888\DiskSpaceMonitor\Providers;

use Illuminate\Console\Scheduling\Schedule;;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Rich1888\DiskSpaceMonitor\Commands\CheckDiskSpace;


class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/config.php', 'disk-space-monitor'
        );

		$this->commands([
			CheckDiskSpace::class,
		]);
    }

    public function booted()
    {
		$this->publishes([
			__DIR__ . '/../../config/config.php' => base_path('config/disk-space-monitor.php'),
		], 'disk-space-monitor');

		$this->app->booted(function () {
			$schedule = $this->app->make(Schedule::class);
			$schedule->command(CheckDiskSpace::class)->cron(config('disk-space-monitor.schedule'));
		});
    }
}
