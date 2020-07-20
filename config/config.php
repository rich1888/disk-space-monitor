<?php

return [
	'email' => env('DISK_USAGE_ALERT_EMAIL'),
	'threshold' => env('DISK_USAGE_ALERT_THRESHOLD', 90),
	'directory' => env('DISK_USAGE_ALERT_DIRECTORY', '/'),
	'schedule' => env('DISK_USAGE_ALERT_SCHEDULE', '0 * * * *')
];