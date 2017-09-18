<?php

namespace App\Repositories\Eloquent\Issue;

use App\Eloquent\Issue\Workflow;
use App\Repositories\Contracts\Issue\WorkflowRepository;
use App\Repositories\RepositoryAbstract;

class EloquentWorkflowRepository extends RepositoryAbstract implements WorkflowRepository
{
    /**
     * Create Workflow entity.
     *
     * @return string
     */
    public function entity()
    {
        return Workflow::class;
    }
}
