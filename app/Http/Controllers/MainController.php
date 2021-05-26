<?php

namespace App\Http\Controllers;

use App\Classes\Workflow\WorkflowEngine;
use App\Models\Subject;
use App\Models\VotingRound;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request): View
    {
        $newSubjects = Subject::where('state', '=', Subject::STATE_NEW)->get();

        $votingRound = VotingRound::inProgress()->first();
        $votingRoundInProgress = $votingRound instanceof VotingRound;
        if (!$votingRoundInProgress) {
            $votingRound = VotingRound::latest('id')->first();
        }

        $activeSubjects = Subject::where('state', '=', Subject::STATE_ACTIVE)->get();
        $archivedSubjects = Subject::where('state', '=', Subject::STATE_ARCHIVED)->get();

        return view('main.index', compact('newSubjects', 'votingRound', 'votingRoundInProgress', 'activeSubjects', 'archivedSubjects'));
    }

    public function trigger(Request $request, string $context, WorkflowEngine $workflowEngine): View
    {
        $view = $workflowEngine->handleTrigger($request, $context);
        if (!$view) {
            abort(404);
        }

        return $view;
    }
}
