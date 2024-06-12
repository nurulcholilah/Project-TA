<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->command('remind:admin-due-date')->timezone('Asia/Jakarta')->at('22:35');
        // $schedule->command('notifications:cleanup')->timezone('Asia/Jakarta')->at('23:00');

        $schedule->command('remind:admin-due-date')
            ->timezone('Asia/Jakarta')
            ->when(function () {
                $now = now()->timezone('Asia/Jakarta');
                return ($now->day == 8 || $now->day == 10) && $now->hour >= 8 && $now->hour < 17;
            })
            ->hourly();

        $schedule->command('notifications:cleanup')
            ->timezone('Asia/Jakarta')
            ->when(function () {
                $now = now()->timezone('Asia/Jakarta');
                return ($now->day == 9 || $now->day == 11) && $now->hour == 0;
            })
            ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
