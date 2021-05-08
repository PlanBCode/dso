<?php

namespace App\Classes\Workflow;

use App\Classes\Workflow\WorkflowModelInterface as WorkflowModel;
use Illuminate\Contracts\View\View;

interface WorkflowInterface
{
    const KEY_CODE = 'code';
    const KEY_TRIGGER_CODE = 'trigger_code';

    const STATE_NEW = 'new';
    const STATE_COMPLETED = 'completed';

    public function setState(string $state): void;

    public function handleTrigger(string $triggerCode): ?View;

    public function setModel(WorkflowModel $model);
}
