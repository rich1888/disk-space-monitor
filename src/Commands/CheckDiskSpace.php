<?php

namespace Rich1888\DiskSpaceMonitor\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class CheckDiskSpace extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:diskspace';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the available disk space on the server, and alert when a threshold is met';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
		$email = config('disk-space-monitor.email');
		$threshold = config('disk-space-monitor.threshold');
		$name = config('app.name');
		$directory = config('disk-space-monitor.directory');

		$msg = $name.' Server free space is less than '.$threshold.'%';

        $freeSpace = disk_free_space($directory);
		$totalSpace = disk_total_space($directory);

		$availablePercentage = ($freeSpace / $totalSpace) * 100;

		if ($availablePercentage <= $threshold) {
			Log::critical($msg);

			if ($email) {
				Mail::raw($msg, function ($message) use ($email) {
					$message->to($email);
				});
			}
		}
	}
}
