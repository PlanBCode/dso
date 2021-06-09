<?php

namespace App\Listeners\SendMail;

use App\Events\Subject\AcceptWithMail;
use App\Mail\MailingSend;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SubjectAcceptWithMailListener
{
    public function handle(AcceptWithMail $event): void
    {
        $subject = $event->getSubject();

        $state = $subject->state;

        if ($state !== Subject::STATE_DRAFT) {
            return;
        }

        $newState = $event->isAccept() ? Subject::STATE_NEW : Subject::STATE_REJECTED;
        $subject->lock_user_id = null;
        $subject->state = $newState;
        $subject->save();

        $mailSubject = $event->getMailSubject();
        $mailContent = $event->getMailContent();
        $this->mailStateToSuggester($mailSubject, $mailContent, $subject);
    }

    protected function mailStateToSuggester(string $mailSubject, string $mailContent, Subject $subject)
    {
        $subjectSuggestion = $subject->suggestion;

        $projectUrl = route('home');
        $recreateUrl = route('subject-suggestion-recreate', ['subjectSuggestion' => $subjectSuggestion, 'email' => $subjectSuggestion->email]);
        $replaceMtx = [
            '[link-to-projects]' => '<a href="' . $projectUrl . '">' . $projectUrl . '</a>',
            '[link-to-recreate-subject]' => '<a href="' . $recreateUrl . '">' . $recreateUrl . '</a>',
        ];
        $content = str_replace(array_keys($replaceMtx), array_values($replaceMtx), $mailContent);
        $content = nl2br($content);

        $fromName = config('mail.from.name');
        $fromEmail = config('mail.from.address');
        $replyTo = config('mail.from.address');

        $mail = new MailingSend($content, $mailSubject, $fromName, $fromEmail, $replyTo);

        $to = [
            [
                'email' => $subjectSuggestion->email,
                'name' => $subjectSuggestion->firstname . ' ' . $subjectSuggestion->lastname,
            ]
        ];
        $bcc = User::getEmails();

        Mail::to($to)->bcc($bcc)->send($mail);
    }
}
