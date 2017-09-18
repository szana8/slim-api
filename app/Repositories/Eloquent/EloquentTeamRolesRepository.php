<?php

namespace App\Repositories\Eloquent;

use App\Eloquent\Admin\Role;
use App\Repositories\RepositoryAbstract;
use App\Repositories\Contracts\TeamRolesRepository;

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
