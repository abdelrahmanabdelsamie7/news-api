<?php
namespace App\Mail;
use App\Models\ShareIdea;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminReplyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $idea;
    public function __construct(ShareIdea $idea)
    {
        $this->idea = $idea;
    }
    public function build()
    {
        return $this->subject('Reply to Your Idea Submission')
            ->view('emails.reply_to_user')
            ->with([
                'name' => $this->idea->name,
                'reply' => $this->idea->reply,
            ]);
    }
}