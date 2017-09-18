<?php

namespace App\Transformers\Authorization;

use App\Eloquent\Admin\Role;
use League\Fractal\TransformerAbstract;

class RoleTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include.
     *
     * @var array
     */
    protected $availableIncludes = [
        'permissions',
    ];

    /**
     * Return the array of the roles.
     *
     * @param Role $role
     *
     * @return array Array of the roles
     */
    public function transform(Role $role)
    {
        return [
            'name'         => $role->name,
            'display_name' => $role->display_name,
            'description'  => $role->description,
        ];
    }

    /**
     * @param Role $role
     *
     * @return \League\Fractal\Resource\Collection
     */
    public function includePermissions(Role $role)
    {
        return $this->collection($role->permissions, new PermissionTransformer());
    }
}
