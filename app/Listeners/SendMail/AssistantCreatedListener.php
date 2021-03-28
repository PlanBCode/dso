<?php

namespace App\Listeners\SendMail;

use App\Events\Assistant\Created;
use App\Mail\MailingSend;
use Illuminate\Support\Facades\Mail;

class AssistantCreatedListener
{
    public function handle(Created $event): void
    {
        $assistant = $event->getAssistant();

        $confirmationUrl = route('assistant-confirm-email', [
            'assistant' => $assistant,
            'code' => $assistant->email_confirmation_code
        ]);

        $viewData = ['url' => $confirmationUrl];
        $content = (string)view('mail.assistants.confirmation', $viewData);
        $content = nl2br($content);

        $fromName = config('mail.from.name');
        $fromEmail = config('mail.from.address');
        $replyTo = config('mail.from.address');

        $mailSubject = 'Bevestig e-mailadres - De Stadsbron onderzoekt';

        $mail = new MailingSend($content, $mailSubject, $fromName, $fromEmail, $replyTo);

        $to = $assistant->email;

        Mail::to($to)->send($mail);
    }
}
