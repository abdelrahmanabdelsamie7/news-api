<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $news;

    public function __construct($news)
    {
        $this->news = $news;
    }

    public function build()
    {
        return $this->subject('خبر جديد!')
            ->view('emails.news_added')
            ->with(['news' => $this->news]);
    }
}
