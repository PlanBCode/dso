<?php

namespace App\Models;

use App\Classes\Workflow\WorkflowModelInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workflow extends Model implements WorkflowModelInterface
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fqcn',
        'code',
        'context',
        'state',
        'data',
        'workflow_data',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
        'workflow_data' => 'array',
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function getFqcn(): string
    {
        return $this->fqcn;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getContext(): string
    {
        return $this->context;
    }

    public function getWorkflowData(): array
    {
        return $this->workflow_data;
    }
}
