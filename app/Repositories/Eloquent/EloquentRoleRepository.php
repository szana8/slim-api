<?php

namespace App\Repositories\Eloquent;

use App\Eloquent\Admin\Role;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\RepositoryAbstract;

class EloquentRoleRepository extends RepositoryAbstract implements RoleRepository
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
