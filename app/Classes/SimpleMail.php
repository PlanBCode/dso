<?php

namespace App\Classes;

use App\Mail\MailingSend;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;

class SimpleMail
{
    /** @var View */
    protected $view;

    /** @var string */
    protected $subject;

    /** @var array */
    protected $to;

    public function __construct(View $view, string $subject, array $to)
    {
        $this->view = $view;
        $this->subject = $subject . ' - ' . config('app.name');
        $this->to = $to;
    }

    public function send()
    {
        $content = nl2br($this->view->render());

        $fromName = config('mail.from.name');
        $fromEmail = config('mail.from.address');
        $replyTo = config('mail.from.address');

        $mail = new MailingSend($content, $this->subject, $fromName, $fromEmail, $replyTo);

        Mail::to($this->to)->send($mail);
    }
}
