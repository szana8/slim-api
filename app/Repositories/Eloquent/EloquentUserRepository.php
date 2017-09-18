<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\UserRepository;
use App\Repositories\RepositoryAbstract;
use App\User;

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
