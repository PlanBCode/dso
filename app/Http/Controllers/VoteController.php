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
            'vote' => 'integer',
            'help' => 'array',
        ]);
        $data['agree_to_terms'] = true;
        $data['contact'] =  $request->has('contact');
        $data['voting_round_id'] = VotingRound::inProgress()->first()->id;
        $submittedVote = !empty($data['vote']);
        $submittedHelp = !empty($data['help']);

        /** @var Vote $workflow */
        $workflow = $workflowEngine->createWorkflow(Vote::class, $data);
        $vote = $workflow->getVoterVote($data['voting_round_id'], $data['email']);
        $overwrite = $vote instanceof VoteModel;

        $lines = [];
        if ($submittedVote && $submittedHelp) {
            $lines[] = ['type' => 'header', 'text' => 'Bedankt voor je stem, en leuk dat je wilt meehelpen onderzoeken.'];
            if ($overwrite) {
                $lines[] = ['type' => 'text', 'text' => 'Je hebt al eerder een stem uitgebracht. Omdat je één keer per stemronde een onderwerp kunt kiezen, telt alleen je meest recente stem. Na het bevestigen van je e-mail komt je vorige stem dus te vervallen.'];
            }
            $lines[] = ['type' => 'warning', 'text' => 'Let op: je hebt een e-mail van ons ontvangen om je mailadres te bevestigen. Alleen dan ontvangen we je aanmelding en stem.'];
            $lines[] = ['type' => 'text', 'text' => 'Over twee weken weten we welk onderwerp de meeste stemmen heeft gekregen en welk onderwerp dus onderzocht gaat worden door de Stadsbron. We houden je op de hoogte wanneer het zover is! Je krijgt dan automatisch een mailtje. En we nemen contact met je op wanneer we weten hoe jij bij het onderzoek kunt helpen.'];
        } elseif ($submittedVote) {
            $lines[] = ['type' => 'header', 'text' => 'Dankjewel voor je stem!'];
            if ($overwrite) {
                $lines[] = ['type' => '', 'text' => 'Je hebt al eerder een stem uitgebracht. Omdat je één keer per stemronde een onderwerp kunt kiezen, telt alleen je meest recente stem. Na het bevestigen van je e-mail komt je vorige stem dus te vervallen.'];
            }
            $lines[] = ['type' => 'warning', 'text' => 'Let op: je hebt een e-mail van ons ontvangen om je mailadres te bevestigen. Alleen dan ontvangen we je stem.'];
            $lines[] = ['type' => 'text', 'text' => 'Over twee weken weten we welk onderwerp de meeste stemmen heeft gekregen en welk onderwerp dus onderzocht gaat worden door de Stadsbron. We houden je op de hoogte wanneer het zover is! Je krijgt dan automatisch een mailtje.'];
        } elseif ($submittedHelp) {
            $lines[] = ['type' => 'header', 'text' => 'Leuk dat je wil meehelpen onderzoeken.'];
            $lines[] = ['type' => 'warning', 'text' => 'Let op: je hebt een e-mail van ons ontvangen om je mailadres te bevestigen. Alleen dan ontvangen we je aanmelding.'];
            $lines[] = ['type' => 'text', 'text' => 'Zodra we weten welk onderwerp onderzocht gaat worden, krijg je van ons bericht. En we nemen contact met je op wanneer we weten hoe jij bij dit onderzoek kunt helpen.'];
        }

        $responseData = [
            'status' => 'ok',
            'lines' => $lines,
        ];

        return response()->json($responseData);
    }
}
