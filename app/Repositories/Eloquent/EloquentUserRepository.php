<?php

namespace App\Repositories\Eloquent;

use App\User;
use App\Repositories\RepositoryAbstract;
use App\Repositories\Contracts\UserRepository;

class EloquentUserRepository extends RepositoryAbstract implements UserRepository
{
    /**
     * @return string
     */
    public function entity()
    {
        return User::class;
    }

    public function profile()
    {
        return $this->entity()->profile();
    }
}
