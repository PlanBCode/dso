<?php

namespace App\Classes\Workflow\Flows;

use App\Classes\Workflow\AbstractWorkflow;
use App\Classes\Workflow\WorkflowInterface;

class VotingRound extends AbstractWorkflow implements WorkflowInterface
{
    public function handle()
    {
        dd($this->data);
    }
}
