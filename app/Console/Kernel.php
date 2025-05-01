<?php

namespace App\Console;

use App\Console\Commands\AllCron;
use App\Console\Commands\BackupDatabase;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        AllCron::class,
        BackupDatabase::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        //Schedules at 12 am night
        $schedule->command('all:cron')->dailyAt('12:00');

        // Run the task every Sunday at 00:00
        $schedule->command('backup:database')->weekly();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
