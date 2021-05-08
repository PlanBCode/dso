<?php

namespace App\Classes\Workflow;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use InvalidArgumentException;
use ReflectionClass;

class WorkflowEngine
{
    /** @var string|WorkflowModelInterface */
    private $modelFqcn;

    public function __construct(string $modelFqcn = 'App\Models\Workflow')
    {
        $reflection = new ReflectionClass($modelFqcn);
        if (!$reflection->implementsInterface(WorkflowModelInterface::class)) {
            throw new InvalidArgumentException('invalid workflow model class');
        }
        $this->modelFqcn = $modelFqcn;
    }

    public function createWorkflow(string $fqcn, array $data): WorkflowInterface
    {
        $reflection = new ReflectionClass($fqcn);
        if (!$reflection->implementsInterface(WorkflowInterface::class)) {
            throw new InvalidArgumentException('invalid workflow class');
        }

        $model = $this->createModel($reflection, $data);
        $workflow = $this->constructWorkflow($model);
        $workflow->setState(WorkflowInterface::STATE_NEW);

        return $workflow;
    }

    protected function createModel(ReflectionClass $reflection, array $data): WorkflowModelInterface
    {
        $fqcn = $reflection->getName();
        $code = (string)Str::uuid();
        $context = Str::snake($reflection->getShortName());
        $workflow_data = [];
        $state = '';

        return $this->modelFqcn::create(compact('fqcn', 'code', 'context', 'data', 'workflow_data', 'state'));
    }

    protected function getWorkflowFromContextAndCode(string $context, string $code): ?WorkflowInterface
    {
        $model = $this->modelFqcn::where(compact('context', 'code'))->first();
        if ($model instanceof $this->modelFqcn) {
            return $this->constructWorkflow($model);
        }

        return null;
    }

    protected function constructWorkflow(WorkflowModelInterface $model): WorkflowInterface
    {
        /** @var WorkflowInterface $workflow */
        $workflow = app($model->getFqcn());
        $workflow->setModel($model);

        return $workflow;
    }

    public function handleTrigger(Request $request, $context): ?View
    {
        $code = $request->get(WorkflowInterface::KEY_CODE);
        $workflow = $this->getWorkflowFromContextAndCode($context, $code);
        if (!$workflow instanceof WorkflowInterface) {
            abort(404);
        }

        $triggerCode = $request->get(WorkflowInterface::KEY_TRIGGER_CODE);

        return $workflow->handleTrigger($triggerCode);
    }
}
