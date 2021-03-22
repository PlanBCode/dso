<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailingSend extends Mailable
{
    use Queueable, SerializesModels;

    /** @var string */
    protected $content;

    /** @var array */
    protected $data;

    /**
     * Create a new message instance.
     *
     * @param  string  $content
     * @param  string  $subject
     * @param  string  $fromName
     * @param  string  $fromEmail
     * @param  string  $replyTo
     */
    public function __construct(string $content, string $subject, string $fromName, string $fromEmail, string $replyTo)
    {
        $this->content = $content;
        $this->data = compact('subject', 'fromName', 'fromEmail', 'replyTo');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.raw', ['content' => $this->content])
            ->subject($this->data['subject'])
            ->from($this->data['fromEmail'], $this->data['fromName'])
            ->replyTo($this->data['replyTo']);
    }
}
