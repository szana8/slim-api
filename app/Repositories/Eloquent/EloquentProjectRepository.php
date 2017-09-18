<?php

namespace App\Repositories\Eloquent;

use App\Eloquent\Project;
use App\Repositories\RepositoryAbstract;
use App\Repositories\Contracts\ProjectRepository;

class EloquentProjectRepository extends RepositoryAbstract implements ProjectRepository
{
    /**
     * Create Project entity.
     *
     * @return string
     */
    public function entity()
    {
        return Project::class;
    }
}
