<?php

namespace App\Classes\Workflow;

interface WorkflowModelInterface
{
    public function update(array $data);
    public function save(array $option = []);

    public function getFqcn(): string;
    public function getData(): array;
    public function getState(): string;
    public function getCode(): string;
    public function getContext(): string;
    public function getId(): int;
    public function getWorkflowData(): array;
}
