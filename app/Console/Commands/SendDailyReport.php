<?php

namespace App\Console\Commands;

use App\Mail\DailyReportMail;
use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

class SendDailyReport extends Command
{
    protected $signature = 'report:daily';

    protected $description = 'Run migrations, seed database, and send daily report of new posts and users to admin';

    public function handle()
    {
        // Run migrations
        $this->info('Running migrations...');
        Artisan::call('migrate', ['--force' => true]);
        $this->info(Artisan::output());

        // Run seeders
        $this->info('Running database seeders...');
        Artisan::call('db:seed', ['--force' => true]);
        $this->info(Artisan::output());

        $today = now()->startOfDay();

        $newPosts = Post::where('created_at', '>=', $today)->get();
        $newUsers = User::where('created_at', '>=', $today)->get();

        Mail::to('osamasowidan1@gmail.com')->send(new DailyReportMail($newPosts, $newUsers));

        $this->info('Daily report sent successfully!');
    }
}
