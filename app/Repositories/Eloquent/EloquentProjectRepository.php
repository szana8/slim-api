<?php

namespace App\Repositories\Eloquent;

use App\Eloquent\Project;
use App\Repositories\Contracts\ProjectRepository;
use App\Repositories\RepositoryAbstract;

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
