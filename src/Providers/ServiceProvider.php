<?php

namespace Rich1888\DiskSpaceMonitor\Providers;

use Aero\Common\Providers\ModuleServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Routing\Router;
use Rich1888\DiskSpaceMonitor\Commands\CheckDiskSpace;


class ServiceProvider extends ModuleServiceProvider
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
