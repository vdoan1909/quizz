<?php

namespace App\Listeners;

use App\Events\QuizCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;
use Illuminate\Queue\InteractsWithQueue;

class QuizCompletedNotification implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(QuizCompleted $event): void
    {
        $data = $event->data;
        $subject = "Thông báo hoàn thành bài kiểm tra";

        Mail::send("mail.quiz-completed", $data, function (Message $message) use ($data, $subject) {
            $message->from(env('MAIL_USERNAME'), env('APP_NAME'));
            $message->to($data["email"], $data["user_name"]);
            $message->subject($subject);
        });
    }
}
