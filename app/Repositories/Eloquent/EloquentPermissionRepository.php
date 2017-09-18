<?php

namespace App\Repositories\Eloquent;

use App\Eloquent\Admin\Permission;
use App\Repositories\Contracts\PermissionRepository;
use App\Repositories\RepositoryAbstract;

class EloquentPermissionRepository extends RepositoryAbstract implements PermissionRepository
{
    /**
     * Create Permission entity.
     *
     * @return string
     */
    public function entity()
    {
        return Permission::class;
    }
}
