<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\DueDateReminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class RemindAdminAboutDueDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remind:admin-due-date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reminds admin about the due date of invoices';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $admins = User::role('admin')->get();
        Notification::send($admins, new DueDateReminder());

        $this->info('Admin reminded about the due date.');
    }
}