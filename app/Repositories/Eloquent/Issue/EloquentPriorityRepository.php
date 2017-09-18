<?php

namespace App\Repositories\Eloquent\Issue;

use App\Eloquent\Issue\Priority;
use App\Repositories\Contracts\Issue\PriorityRepository;
use App\Repositories\RepositoryAbstract;

class EloquentPriorityRepository extends RepositoryAbstract implements PriorityRepository
{
    /**
     * Create GeneralSettings entity.
     *
     * @return GeneralSetting
     */
    public function entity()
    {
        return Priority::class;
    }
}
