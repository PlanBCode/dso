<?php

namespace App\Classes\Workflow\Flows;

use App\Classes\Workflow\AbstractWorkflow;
use App\Classes\Workflow\WorkflowInterface;
use App\Mail\MailingSend;
use App\Models\Subject;
use App\Models\VotingRound;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Models\Vote as VoteModel;

class Vote extends AbstractWorkflow implements WorkflowInterface
{
    const KEY_EMAIL_CONFIRMED_VIEW_DATA = 'email_confirmed_view_data';

    const STATE_WAITING_FOR_EMAIL_CONFIRMATION = 'waiting_for_email_confirmation';
    const STATE_EMAIL_CONFIRMED = 'email_confirmed';

    protected function getStateHandlers(): array
    {
        return [
            self::STATE_NEW => [$this, 'handleStateNew'],
            self::STATE_EMAIL_CONFIRMED => [$this, 'handleStateEmailConfirmed'],
        ];
    }

    public function triggerEmailConfirmed(): View
    {
        $workflowData = $this->workflowData;
        if (!array_key_exists(self::KEY_EMAIL_CONFIRMED_VIEW_DATA, $workflowData)) {
            // Check if voting round is in progress.
            $voting_round_id = Arr::get($this->data, 'voting_round_id');
            /** @var VotingRound $votingRound */
            $votingRound = VotingRound::find($voting_round_id);
            if (!$votingRound instanceof VotingRound) {
                abort(404);
            }

            // TODO [LRM]: implement correct views
            if (!$votingRound->in_progress) {
                $view = view('home', ['itemsCenter' => false]);
            } else {
                $view = view('home', ['itemsCenter' => true]);
            }
            $workflowData[self::KEY_EMAIL_CONFIRMED_VIEW_DATA] = ['name' => $view->name(), 'data' => $view->getData()];
            $this->setWorkflowData($workflowData);

            if ($this->state === self::STATE_WAITING_FOR_EMAIL_CONFIRMATION) {
                $this->setState(self::STATE_EMAIL_CONFIRMED);
            }
        }

        $viewData = $workflowData[self::KEY_EMAIL_CONFIRMED_VIEW_DATA];

        return view($viewData['name'], $viewData['data']);
    }

    protected function handleStateNew()
    {
        $triggerUrl = $this->newTrigger([$this, 'triggerEmailConfirmed']);

        $viewData = ['url' => $triggerUrl];
        $content = (string)view('mail.vote.confirmation', $viewData);
        $content = nl2br($content);

        $fromName = config('mail.from.name');
        $fromEmail = config('mail.from.address');
        $replyTo = config('mail.from.address');

        $mailSubject = 'Bevestig e-mailadres voor de stemronde - ' . config('app.name');

        $mail = new MailingSend($content, $mailSubject, $fromName, $fromEmail, $replyTo);

        $to = [
            [
                'email' => $this->data['email'],
            ]
        ];

        Mail::to($to)->send($mail);

        $this->setState(self::STATE_WAITING_FOR_EMAIL_CONFIRMATION, true);

        return null;
    }

    protected function handleStateEmailConfirmed()
    {
        // Check if voting round is in progress.
        $votingRoundId = Arr::get($this->data, 'voting_round_id');
        /** @var VotingRound $votingRound */
        $votingRound = VotingRound::find($votingRoundId);
        if (!$votingRound->in_progress) {
            return null;
        }

        $email = Arr::get($this->data, 'email');
        $subjectId = Arr::get($this->data, 'vote');

        /** @var VoteModel $vote */
        $vote = VoteModel::where(['voting_round_id' => $votingRoundId, 'email' => $email])->isEnabled()->first();
        if ($vote instanceof VoteModel) {
            $vote->update(['disabled' => true]);
        }
        $vote = VoteModel::create([
            'voting_round_id' => $votingRoundId,
            'subject_id' => $subjectId,
            'email' => $email,
            'why_important' => Arr::get($this->data, 'importance'),
            'extra' => [
                'assist' => Arr::get($this->data, 'assist'),
                'help' => Arr::get($this->data, 'help'),
                'contact' => Arr::get($this->data, 'contact'),
            ],
            'agree_to_terms' => Arr::get($this->data, 'agree_to_terms'),
        ]);

        $vote->save();

        $this->setState(self::STATE_COMPLETED);

        return null;
    }
}
