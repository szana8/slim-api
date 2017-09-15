<?php

namespace App\Repositories\Eloquent;

use App\Eloquent\Admin\Team;
use App\Repositories\RepositoryAbstract;
use App\Repositories\Contracts\TeamRepository;

class EloquentTeamRepository extends RepositoryAbstract implements TeamRepository
{
    /**
     * Create team entity.
     *
     * @return Team
     */
    public function entity()
    {
        return Team::class;
    }
}
