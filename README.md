# Disk Space Monitor
Check the available disk space on the server, and alert when a threshold is met.

### Getting Started

- Set env variable `DISK_USAGE_ALERT_EMAIL` to correct email address to receive email
- Set env variable `DISK_USAGE_ALERT_THRESHOLD` to be the threshold where alerts start. The default is 90, and will alert when 90% of disk space has been reached.
- Set env variable `DISK_USAGE_ALERT_DIRECTORY` to monitor specific directories on the server. Default is / and will monitor the whole instance.
- Set env variable `DISK_USAGE_ALERT_SCHEDULE` to change how often the process runs. Default is `0 * * * *` which runs on the hour. Use something like https://crontab.guru/ to get the pattern for a new schedule.