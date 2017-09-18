<?php

namespace App\Transformers\Authorization;

use App\Eloquent\Admin\Role;
use App\Transformers\UserTransformer;
use App\User;
use League\Fractal\TransformerAbstract;

class TeamRoleTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include.
     *
     * @var array
     */
    protected $availableIncludes = [
        'team', 'user',
    ];

    /**
     * @param Role $role
     *
     * @return mixed
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
    public function includeTeam(Role $role)
    {
        return $this->collection($role->team, new TeamTransformer());
    }

    /**
     * @param Role $role
     *
     * @return \League\Fractal\Resource\Collection
     */
    public function includeUser(Role $role)
    {
        return $this->collection($role->users, new UserTransformer());
    }
}
