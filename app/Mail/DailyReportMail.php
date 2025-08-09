<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailyReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $newPosts;

    public $newUsers;

    public function __construct($newPosts, $newUsers)
    {
        $this->newPosts = $newPosts;
        $this->newUsers = $newUsers;
    }

    public function build()
    {
        return $this->subject('Daily Report - New Posts & Users')
            ->view('emails.daily_report');
    }
}
