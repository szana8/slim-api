<?php

namespace App\Repositories\Eloquent;

use App\Eloquent\Admin\Role;
use App\Repositories\Contracts\TeamRolesRepository;
use App\Repositories\RepositoryAbstract;

class EloquentTeamRolesRepository extends RepositoryAbstract implements TeamRolesRepository
{
    /**
     * Create Role entity.
     *
     * @return Role
     */
    public function entity()
    {
        return Role::class;
    }
}
