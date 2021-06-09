<?php

namespace App\Listeners\AutoPopulateSubject;

use App\Events\Subject\CreatedWithSuggestion;
use App\Events\SubjectSuggestion\Updated;
use App\Models\Subject;

class SubjectSuggestionUpdatedListener
{
    public function handle(Updated $event): void
    {
        $this->handleEmailConfirmation($event);
    }

    protected function handleEmailConfirmation(Updated $event): void
    {
        $subjectSuggestion = $event->getSubjectSuggestion();
        $oldConfirmed = $subjectSuggestion->getOriginal('email_confirmed');
        $newConfirmed = $subjectSuggestion->getAttribute('email_confirmed');
        if ($oldConfirmed || !$newConfirmed) {
            return;
        }

        // refresh to prevent recursive loop
        $subjectSuggestion = $subjectSuggestion->refresh();

        $data = [
            'title' => $subjectSuggestion->title,
            'short_description' => $subjectSuggestion->description,
            'description' => $subjectSuggestion->description,
            'importance' => $subjectSuggestion->importance,
        ];
        $subject = new Subject($data);
        $subject->save();
        $subjectSuggestion->subject()->associate($subject);
        $subjectSuggestion->save();

        CreatedWithSuggestion::dispatch($subject);
    }
}
