<?php

namespace App\Classes\Workflow\Flows;

use App\Classes\Workflow\AbstractWorkflow;
use App\Classes\Workflow\WorkflowInterface;
use App\Mail\MailingSend;
use App\Models\VotingRound;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Models\Vote as VoteModel;

class Vote extends AbstractWorkflow implements WorkflowInterface
{
    const KEY_EMAIL_CONFIRMED_VIEW_DATA = 'email_confirmed_view_data';

    const STATE_WAITING_FOR_EMAIL_CONFIRMATION = 'waiting_for_email_confirmation';

    protected function getStateHandlers(): array
    {
        return [
            self::STATE_NEW => [$this, 'handleStateNew'],
        ];
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

    public function triggerEmailConfirmed(): View
    {
        $workflowData = $this->workflowData;

        // save response variables so the second times the confirmation link is clicked the response is the same.
        if (!array_key_exists(self::KEY_EMAIL_CONFIRMED_VIEW_DATA, $workflowData)) {
            $voting_round_id = Arr::get($this->data, 'voting_round_id');
            /** @var VotingRound $votingRound */
            $votingRound = VotingRound::find($voting_round_id);
            if (!$votingRound instanceof VotingRound) {
                abort(404);
            }

            // Check if voting round is in progress.
            $email = Arr::get($this->data, 'email');
            $vote = $this->getVoterVote($voting_round_id, $email);
            $overwrite = $vote instanceof VoteModel;
            $in_progress = $votingRound->in_progress;

            $view = view('vote.confirm-email', compact('overwrite', 'in_progress'));
            $workflowData[self::KEY_EMAIL_CONFIRMED_VIEW_DATA] = ['name' => $view->name(), 'data' => $view->getData()];
            $this->setWorkflowData($workflowData);

            if ($this->state === self::STATE_WAITING_FOR_EMAIL_CONFIRMATION) {
                $this->handleStateEmailConfirmed($votingRound, $vote);
                $this->setState(self::STATE_COMPLETED);
            }
        }

        $viewData = $workflowData[self::KEY_EMAIL_CONFIRMED_VIEW_DATA];

        return view($viewData['name'], $viewData['data']);
    }

    public function getVoterVote(int $votingRoundId, string $email): ?VoteModel
    {
        return VoteModel::where(['voting_round_id' => $votingRoundId, 'email' => $email])->isEnabled()->first();
    }

    protected function handleStateEmailConfirmed(VotingRound $votingRound, VoteModel $foundVote = null)
    {
        // Check if voting round is in progress.
        $votingRoundId = Arr::get($this->data, 'voting_round_id');
        if (!$votingRound->in_progress) {
            return null;
        }

        if ($foundVote instanceof VoteModel) {
            $foundVote->update(['disabled' => true]);
        }

        $vote = VoteModel::create([
            'voting_round_id' => $votingRoundId,
            'subject_id' => Arr::get($this->data, 'vote'),
            'email' => Arr::get($this->data, 'email'),
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
