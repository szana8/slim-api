<?php

namespace App\Repositories\Eloquent\Issue;

use App\Eloquent\Issue\Screens;
use App\Repositories\RepositoryAbstract;
use App\Repositories\Contracts\Issue\ScreenRepository;

class EloquentScreenRepository extends RepositoryAbstract implements ScreenRepository
{
    /**
     * Create GeneralSettings entity.
     *
     * @return GeneralSetting
     */
    public function entity()
    {
        return Screens::class;
    }
}
