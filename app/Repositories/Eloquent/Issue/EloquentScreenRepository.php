<?php

namespace App\Repositories\Eloquent\Issue;

use App\Eloquent\Issue\Screens;
use App\Repositories\Contracts\Issue\ScreenRepository;
use App\Repositories\RepositoryAbstract;

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
