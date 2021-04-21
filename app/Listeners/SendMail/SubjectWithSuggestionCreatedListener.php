<?php

namespace App\Listeners\SendMail;

use App\Events\Subject\CreatedWithSuggestion;
use App\Mail\MailingSend;
use App\Models\SubjectSuggestion;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SubjectWithSuggestionCreatedListener
{
    public function handle(CreatedWithSuggestion $event): void
    {
        $subject = $event->getSubject();
        $subjectSuggestion = $subject->suggestion;

        if (!$subjectSuggestion instanceof SubjectSuggestion) {
            return;
        }

        $subjectUrl = route('admin-subject-show', [
            'subject' => $subject,
        ]);

        $viewData = ['url' => $subjectUrl];
        $content = (string)view('mail.subjects.created-with-suggestion', $viewData);
        $content = nl2br($content);

        $fromName = config('mail.from.name');
        $fromEmail = config('mail.from.address');
        $replyTo = config('mail.from.address');

        $mailSubject = 'Nieuw onderwerp - ' . config('app.name');

        $mail = new MailingSend($content, $mailSubject, $fromName, $fromEmail, $replyTo);

        $to = User::getEmails();

        Mail::to($to)->send($mail);
    }
}
