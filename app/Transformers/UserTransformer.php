<?php


namespace App\Transformers;


use App\User;
use League\Fractal\TransformerAbstract;
use App\Transformers\Authorization\RoleTransformer;

class UserTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        'roles'
    ];

    /**
     * Return the transformed user data.
     * 
     * @param  User     User Object
     * @return Array    Array of user properties
     */
    public function transform(User $user)
    {
        return [
            'name' => $user->name,
            'email' => $user->email,
        ];
    }
    /**
     * Include the user roles to the API data output.
     *
     * @param  User         User Object
     * @return Collection   Collection of the roles
     */
    public function includeRoles(User $user)
    {
        return $this->collection($user->roles, new RoleTransformer);
    }


}