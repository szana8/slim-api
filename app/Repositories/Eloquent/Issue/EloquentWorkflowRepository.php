<?php

namespace App\Repositories\Eloquent\Issue;

use App\Eloquent\Issue\Workflow;
use App\Repositories\RepositoryAbstract;
use App\Repositories\Contracts\Issue\WorkflowRepository;

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
