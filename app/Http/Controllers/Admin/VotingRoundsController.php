<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Form;
use App\Http\Controllers\Controller;
use App\Models\VotingRound;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VotingRoundsController extends Controller
{
    public function index(Request $request): View
    {
        $voting_rounds = VotingRound::all();

        return view('admin.voting_rounds.index', compact('voting_rounds'));
    }

    public function create(Request $request): View
    {
        $action = route('admin-voting-round-store');
        $form = new Form\Form('createVotingRound', $action, 'POST');
        $this->setFields($form);
        $indexUrl = route('admin-voting-round-index');

        return view('admin.voting_rounds.form', compact('form', 'indexUrl'));
    }

    public function show(Request $request, VotingRound $voting_round): View
    {
        $votes = [];
        foreach ($voting_round->votes as $vote) {
            if (empty($votes[$vote->subject_id])) {
                $votes[$vote->subject_id] = 0;
            }
            $votes[$vote->subject_id]++;
        }

        return view('admin.voting_rounds.show', compact('voting_round', 'votes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'begin' => 'required|date|before:'.$request->get('end'),
            'end' => 'required|date|after:'.$request->get('begin'),
        ]);
        $votingRound = VotingRound::create($data);

        return redirect()->route('admin-voting-round-show', ['voting_round' => $votingRound]);
    }

    public function destroy(Request $request, VotingRound $votingRound)
    {
        $votingRound->delete();

        return redirect()->route('admin-voting-round-index');
    }

    protected function setFields(Form\Form $form, VotingRound $votingRound = null)
    {
        $form->addField(
            (new Form\Text('begin'))
                ->setSubType(Form\Text::SUB_TYPE_DATE)
                ->setRequired()
                ->setValue($votingRound ? $votingRound->begin : null)
                ->setLabel('begin')
                ->setAttributes(['min' => date('Y-m-d', strtotime(Carbon::now() ))])
        );
        $form->addField(
            (new Form\Text('end'))
                ->setSubType(Form\Text::SUB_TYPE_DATE)
                ->setRequired()
                ->setValue($votingRound ? $votingRound->begin : null)
                ->setLabel('end')
                ->setAttributes(['min' => date('Y-m-d', strtotime(Carbon::now() ))])
        );
        $form->addField(
            (new Form\Text('save'))
                ->setSubType(Form\Text::SUB_TYPE_SUBMIT)
                ->setValue('Submit')
                ->setAttributes(['class' => 'btn btn-primary'])
        );
    }
}
