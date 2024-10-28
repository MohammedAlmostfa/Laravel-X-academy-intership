<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Jobs\SendMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            {
                $tasks = $user->tasks()->whereDate('created_at', today())->where('status', null)->pluck('Task_name')->toArray();
                $subject = 'Your pending Tasks: ' . implode(', ', $tasks);



                $dispatchData = [
                    'mail_to' => $user->email,
                    'subject' => $subject,
                    'message' => "Hello {$user->name},\n\nHere are your tasks: " . implode(', ', $tasks) . "\n\nBest regards,\nYour Task Manager",
                ];

                SendMail::dispatch($dispatchData);


            }
        }
    }
}
