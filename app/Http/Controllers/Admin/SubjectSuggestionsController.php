<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\MailingSend;
use App\Models\SubjectSuggestion;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubjectSuggestionsController extends Controller
{
    public function accept(Request $request, SubjectSuggestion $subjectSuggestion): RedirectResponse
    {
        $subject = $subjectSuggestion->subject;
        $subject->update(['state' => 'new']);

        $this->sendMail($request, $subjectSuggestion);

        return back();
    }

    public function reject(Request $request, SubjectSuggestion $subjectSuggestion): RedirectResponse
    {
        $subject = $subjectSuggestion->subject;
        $subject->update(['state' => 'rejected']);

        $this->sendMail($request, $subjectSuggestion);

        return back();
    }

    protected function sendMail(Request $request, SubjectSuggestion $subjectSuggestion)
    {
        $subject = $request->get('subject');
        $content = $request->get('message');

        $projectUrl = route('projects');
        $createUrl = route('subject-suggestion-create');
        $replaceMtx = [
            '[link-to-projects]' => '<a href="' . $projectUrl . '">' . $projectUrl . '</a>',
            '[link-to-new-subject]' => '<a href="' . $createUrl . '">' . $createUrl . '</a>',
        ];
        $content = str_replace(array_keys($replaceMtx), array_values($replaceMtx), $content);
        $content = nl2br($content);

        $fromName = config('mail.from.name');
        $fromEmail = config('mail.from.address');
        $replyTo = config('mail.from.address');

        $mail = new MailingSend($content, $subject, $fromName, $fromEmail, $replyTo);

        $to = [
            [
                'email' => $subjectSuggestion->email,
                'name' => $subjectSuggestion->firstname . ' ' . $subjectSuggestion->lastname,
            ]
        ];

        Mail::to($to)->send($mail);
    }
}
