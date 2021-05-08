<?php

namespace App\Console\Commands;

use App\Models\Subject;
use App\Models\VotingRound;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class InitializeVotingRoundCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'voting_round:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initializes a scheduled voting round';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->handleBegin();
        $this->handleEnd();
    }

    public function handleBegin()
    {
        //$workflow = new \App\Classes\Workflow\Flows\VotingRound([], \App\Classes\Workflow\Flows\VotingRound::STATE_NEW);

        /** @var Collection|VotingRound[] $votingRounds */
        $votingRounds = VotingRound::where('in_progress', '=', false)->inProgress()->get();

        foreach ($votingRounds as $votingRound) {
            /** @var Builder $subjectQueryBuilder */
            $subjectQueryBuilder = Subject::where('state', '=', Subject::STATE_NEW);

            /** @var Collection|Subject[] $subjects */
            $subjects = $subjectQueryBuilder->get();

            foreach ($subjects as $subject) {
                $votingRound->subjects()->save($subject);
            }

            $votingRound->update(['in_progress' => true]);
            $subjectQueryBuilder->update(['state' => Subject::STATE_IN_VOTING_ROUND]);
        }
    }

    public function handleEnd()
    {
        /** @var Collection|VotingRound[] $votingRounds */
        $votingRounds = VotingRound::where('in_progress', '=', true)->completed()->get();

        foreach ($votingRounds as $votingRound) {
            $votingRound->update(['in_progress' => false]);
        }
    }
}
