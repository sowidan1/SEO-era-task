<?php

namespace App\Console\Commands;

use App\Mail\DailyReportMail;
use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDailyReport extends Command
{
    protected $signature = 'report:daily';

    protected $description = 'Send daily report of new posts and users';

    public function handle()
    {
        $today = now()->startOfDay();

        $newPosts = Post::where('created_at', '>=', $today)->get();
        $newUsers = User::where('created_at', '>=', $today)->get();

        Mail::to('osamasowidan1@gmail.com')->send(new DailyReportMail($newPosts, $newUsers));

        $this->info('Daily report sent successfully!');
    }
}
