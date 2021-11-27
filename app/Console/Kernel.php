<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
	    $schedule->command('checkexpiredvf:cron')->dailyAt('00:01');
	    $schedule->command('deletetempfiles:cron')->dailyAt('03:00');
	    $schedule->command('deleteunusedlocation:cron')->dailyAt('03:00');
	    $schedule->command('synchronizeusers:cron')->dailyAt('03:00');
	    $schedule->command('synchronizecities:cron')->dailyAt('03:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
