<?php

namespace App\Classes\Workflow\Flows;

use App\Classes\SimpleMail;
use App\Classes\Workflow\AbstractWorkflow;
use App\Classes\Workflow\WorkflowInterface;
use App\Models\Subject as SubjectModel;
use App\Models\Vote as VoteModel;
use App\Models\VotingRound as VotingRoundModel;
use Illuminate\Support\Collection;

class VotingRound extends AbstractWorkflow implements WorkflowInterface
{
    public function handleCompleted(VotingRoundModel $votingRound)
    {
        $votes = [];
        foreach ($votingRound->votes as $vote) {
            if (empty($votes[$vote->subject_id])) {
                $votes[$vote->subject_id] = 0;
            }
            $votes[$vote->subject_id]++;
        }

        arsort($votes);
        $maxVoteAmount = reset($votes);
        $winningSubjectIds = [];
        $loosingSubjectIds = [];
        foreach ($votes as $subjectId => $voteAmount) {
            if ($voteAmount === $maxVoteAmount) {
                $winningSubjectIds[] = $subjectId;
            } else {
                $loosingSubjectIds[] = $subjectId;
            }
        }

        $winningSubjectsQueryBuilder = SubjectModel::whereIn('id', $winningSubjectIds);
        foreach ($winningSubjectsQueryBuilder->get() as $winningSubject) {
            $votingRound->winning_subjects()->save($winningSubject);
        }
        $winningSubjectsQueryBuilder->update(['state' => SubjectModel::STATE_ACTIVE]);

        $loosingSubjectsQueryBuilder = SubjectModel::whereIn('id', $loosingSubjectIds);
        $loosingSubjectsQueryBuilder->update(['state' => SubjectModel::STATE_ARCHIVED]);

        $this->sendMailToWinners($winningSubjectsQueryBuilder->get());
        $this->sendMailToLosers($loosingSubjectsQueryBuilder->get());
        $this->sendMailToVoters($votingRound);
    }

    protected function sendMailToWinners(Collection $subjects)
    {
        /** @var SubjectModel $subject */
        foreach ($subjects as $subject) {
            $winningUrl = route('home', ['tab' => 3]);
            $viewData = compact('winningUrl');

            $mailSubject = 'Jouw onderwerp wordt onderzocht door de Stadsbron!';
            $to = [
                [
                    'email' => $subject->suggestion->email,
                    'name' => $subject->suggestion->firstname . ' ' . $subject->suggestion->lastname,
                ]
            ];
            $view = view('mail.voting_rounds.winner', $viewData);
            $mail = new SimpleMail($view, $mailSubject, $to);
            $mail->send();
        }
    }

    protected function sendMailToLosers(Collection $subjects)
    {
        /** @var SubjectModel $subject */
        foreach ($subjects as $subject) {
            $winningUrl = route('home', ['tab' => 3]);
            $archiveUrl = route('home', ['tab' => 4]);
            $createSubjectUrl = route('subject-suggestion-create');
            $viewData = compact('winningUrl', 'archiveUrl', 'createSubjectUrl');

            $mailSubject = 'Je onderwerp kreeg helaas niet de meeste stemmen';
            $to = [
                [
                    'email' => $subject->suggestion->email,
                    'name' => $subject->suggestion->firstname . ' ' . $subject->suggestion->lastname,
                ]
            ];
            $view = view('mail.voting_rounds.loser', $viewData);
            $mail = new SimpleMail($view, $mailSubject, $to);
            $mail->send();
        }
    }

    protected function sendMailToVoters(VotingRoundModel $votingRound)
    {
        /** @var VoteModel $vote */
        foreach ($votingRound->votes as $vote) {
            $winningUrl = route('home', ['tab' => 3]);
            $viewData = compact('winningUrl');

            $mailSubject = 'Onderwerp bekend bij de Stadsbron Onderzoekt';
            $to = [
                [
                    'email' => $vote->email,
                ]
            ];
            $view = view('mail.voting_rounds.after-complete-to-voter', $viewData);
            $mail = new SimpleMail($view, $mailSubject, $to);
            $mail->send();
        }
    }
}
