<?php

namespace App\Classes\Workflow;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

abstract class AbstractWorkflow implements WorkflowInterface
{
    /** @var array */
    protected $data;

    /** @var string */
    protected $state;

    /** @var string */
    protected $code;

    /** @var string */
    protected $context;

    /** @var array */
    protected $workflowData;

    /** @var WorkflowModelInterface */
    private $model;

    public function setModel(WorkflowModelInterface $model)
    {
        $this->model = $model;
        $this->data = $this->model->getData();
        $this->state = $this->model->getState();
        $this->code = $this->model->getCode();
        $this->context = $this->model->getContext();
        $this->workflowData = $this->model->getWorkflowData();
    }

    public function setState(string $state, bool $quiet = false): void
    {
        if ($this->state !== $state) {
            $this->state = $state;
            $this->model->state = $state;
            $this->model->save();
            if ($quiet === false) {
                $this->handle();
            }
        }
    }

    protected function setWorkflowData(array $data)
    {
        $this->workflowData = $data;
        $this->model->update(['workflow_data' => $data]);
    }

    // HANDLE

    protected function getStateHandlers(): array
    {
        return [];
    }

    public function handle()
    {
        $handlers = $this->getStateHandlers();
        if (array_key_exists($this->state, $handlers)) {
            $handlers[$this->state]();
        }
    }

    // TRIGGER

    public function handleTrigger(string $triggerCode): ?View
    {
        $data = $this->workflowData;
        if (!array_key_exists($triggerCode, $data)) {
            return null;
        }

        /** @var callable $callable */
        $method = $data[$triggerCode];
        $callable = [$this, $method];

        return $callable();
    }

    protected function newTrigger(callable $callable): string
    {
        $triggerCode = (string)Str::uuid();
        $this->setTrigger($triggerCode, $callable);

        return $this->constructTriggerUrl($triggerCode);
    }

    private function constructTriggerUrl(string $triggerCode): string
    {
        return route('trigger', [
            'context' => $this->context,
            self::KEY_CODE => $this->code,
            self::KEY_TRIGGER_CODE => $triggerCode,
        ]);
    }

    private function setTrigger(string $triggerCode, callable $callable)
    {
        $data = $this->workflowData;
        $data[$triggerCode] = $callable[1];
        $this->setWorkflowData($data);
    }
}
