<?php

namespace App\Repositories\Eloquent;

use App\Eloquent\Admin\Role;
use App\Repositories\RepositoryAbstract;
use App\Repositories\Contracts\RoleRepository;

class EloquentRoleRepository extends RepositoryAbstract implements RoleRepository
{
    /**
     * @return string
     */
    public function entity()
    {
        return Role::class;
    }

    /**
     * Sync permissions to the role.
     *
     * @param array $permissions
     *
     * @return Role
     */
    public function syncPermissions(array $permissions)
    {
        return $this->entity()->syncPermissions($permissions);
    }
}
