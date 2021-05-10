<?php

namespace App\Http\Controllers;

use App\Classes\Workflow\Flows\Vote;
use App\Classes\Workflow\WorkflowEngine;
use App\Models\Vote as VoteModel;
use App\Models\VotingRound;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function store(Request $request, WorkflowEngine $workflowEngine): JsonResponse
    {
        $data = $request->validate([
            'importance' => 'string|nullable',
            'assist' => 'string|nullable',
            'email' => 'required|email',
            'agree_to_terms' => 'accepted',
            'vote' => 'required|integer',
            'help' => 'array',
        ]);
        $data['agree_to_terms'] = true;
        $data['contact'] =  $request->has('contact');
        $data['voting_round_id'] = VotingRound::inProgress()->first()->id;

        /** @var Vote $workflow */
        $workflow = $workflowEngine->createWorkflow(Vote::class, $data);
        $vote = $workflow->getVoterVote($data['voting_round_id'], $data['email']);
        $overwrite = $vote instanceof VoteModel;

        return response()->json(['status' => 'ok', 'overwrite' => $overwrite]);
    }
}
