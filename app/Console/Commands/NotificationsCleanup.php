<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class NotificationsCleanup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes old notifications after the 10th of each month';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::table('notifications')
            ->where('created_at', '<', now())
            ->delete();

        $this->info('Old notifications deleted.');
    }
}
