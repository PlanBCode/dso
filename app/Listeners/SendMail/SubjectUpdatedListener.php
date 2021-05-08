<?php

namespace App\Listeners\SendMail;

use App\Events\Subject\Updated;
use App\Mail\MailingSend;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SubjectUpdatedListener
{
    public function handle(Updated $event): void
    {
        $subject = $event->getSubject();

        $this->handleClaim($subject);
        $this->handleState($subject);
    }

    protected function getToOtherUsers(): array
    {
        return User::getEmails([Auth::user()->id]);
    }

    protected function handleClaim(Subject $subject)
    {
        if ($subject->state !== Subject::STATE_DRAFT) {
            return;
        }

        $oldLock = $subject->getOriginal('lock_user_id');
        $newLock = $subject->getAttribute('lock_user_id');

        if ($oldLock === $newLock) {
            return;
        }

        switch ($newLock) {
            case true:
                $this->handleClaimed($subject);
                break;
            case false:
                $this->handleClaimReleased($subject);
                break;
        }
    }

    protected function handleClaimed(Subject $subject)
    {
        $viewData = [
            'subject' => $subject->title,
            'user' => Auth::user()->name
        ];
        $content = (string)view('mail.subjects.updated-with-claim', $viewData);
        $content = nl2br($content);

        $fromName = config('mail.from.name');
        $fromEmail = config('mail.from.address');
        $replyTo = config('mail.from.address');

        $mailSubject = 'Onderwerp geclaimed - ' . config('app.name');

        $mail = new MailingSend($content, $mailSubject, $fromName, $fromEmail, $replyTo);

        $to = $this->getToOtherUsers();

        Mail::to($to)->send($mail);
    }

    protected function handleClaimReleased(Subject $subject)
    {
        $subjectUrl = route('admin-subject-show', [
            'subject' => $subject,
        ]);

        $viewData = [
            'subject' => $subject->title,
            'user' => Auth::user()->name,
            'url' => $subjectUrl,
        ];
        $content = (string)view('mail.subjects.updated-with-claim-release', $viewData);
        $content = nl2br($content);

        $fromName = config('mail.from.name');
        $fromEmail = config('mail.from.address');
        $replyTo = config('mail.from.address');

        $mailSubject = 'Onderwerp claim losgelaten - ' . config('app.name');

        $mail = new MailingSend($content, $mailSubject, $fromName, $fromEmail, $replyTo);

        $to = $this->getToOtherUsers();

        Mail::to($to)->send($mail);
    }

    protected function handleState(Subject $subject)
    {
        $oldState = $subject->getOriginal('state');
        $newState = $subject->getAttribute('state');

        if ($oldState === $newState) {
            return;
        }

        switch ($newState) {
            case Subject::STATE_NEW:
                $this->handleStateNew($subject);
                break;
            case Subject::STATE_REJECTED:
                $this->handleStateRejected($subject);
                break;
        }
    }

    protected function handleStateNew(Subject $subject)
    {
        $viewData = [
            'subject' => $subject->title,
            'user' => Auth::user()->name
        ];
        $content = (string)view('mail.subjects.updated-with-state-new', $viewData);
        $content = nl2br($content);

        $fromName = config('mail.from.name');
        $fromEmail = config('mail.from.address');
        $replyTo = config('mail.from.address');

        $mailSubject = 'Onderwerp goedgekeurd - ' . config('app.name');

        $mail = new MailingSend($content, $mailSubject, $fromName, $fromEmail, $replyTo);

        $to = $this->getToOtherUsers();

        Mail::to($to)->send($mail);

        $subject->lock_user_id = null;
        $subject->saveQuietly();
    }

    protected function handleStateRejected(Subject $subject)
    {
        $viewData = [
            'subject' => $subject->title,
            'user' => Auth::user()->name
        ];
        $content = (string)view('mail.subjects.updated-with-state-rejected', $viewData);
        $content = nl2br($content);

        $fromName = config('mail.from.name');
        $fromEmail = config('mail.from.address');
        $replyTo = config('mail.from.address');

        $mailSubject = 'Onderwerp afgekeurd - ' . config('app.name');

        $mail = new MailingSend($content, $mailSubject, $fromName, $fromEmail, $replyTo);

        $to = $this->getToOtherUsers();

        Mail::to($to)->send($mail);

        $subject->lock_user_id = null;
        $subject->saveQuietly();
    }
}
