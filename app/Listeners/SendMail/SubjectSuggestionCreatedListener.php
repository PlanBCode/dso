<?php

namespace App\Listeners\SendMail;

use App\Events\SubjectSuggestion\Created;
use App\Mail\MailingSend;
use Illuminate\Support\Facades\Mail;

class SubjectSuggestionCreatedListener
{
    public function handle(Created $event): void
    {
        $subjectSuggestion = $event->getSubjectSuggestion();

        $confirmationUrl = route('subject-suggestion-confirm-email', [
            'subjectSuggestion' => $subjectSuggestion,
            'code' => $subjectSuggestion->email_confirmation_code
        ]);

        $viewData = ['url' => $confirmationUrl];
        $content = (string)view('mail.subject_suggestions.confirmation', $viewData);
        $content = nl2br($content);

        $fromName = config('mail.from.name');
        $fromEmail = config('mail.from.address');
        $replyTo = config('mail.from.address');

        $mailSubject = 'Bevestig e-mailadres voor nieuw onderzoeksvoorstel - De Stadsbron onderzoekt';

        $mail = new MailingSend($content, $mailSubject, $fromName, $fromEmail, $replyTo);

        $to = [
            [
                'email' => $subjectSuggestion->email,
                'name' => $subjectSuggestion->firstname . ' ' . $subjectSuggestion->lastname,
            ]
        ];

        Mail::to($to)->send($mail);
    }
}
