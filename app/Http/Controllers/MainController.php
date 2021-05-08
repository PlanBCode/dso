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

        return view('main.index', compact('newSubjects', 'votingRound'));
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
