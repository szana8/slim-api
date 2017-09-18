<?php

namespace App\Repositories\Eloquent\Issue;

use App\Eloquent\Issue\ScreenConfig;
use App\Repositories\Contracts\Issue\ScreenConfigRepository;
use App\Repositories\RepositoryAbstract;

class EloquentScreenConfigRepository extends RepositoryAbstract implements ScreenConfigRepository
{
    /**
     * Create GeneralSettings entity.
     *
     * @return GeneralSetting
     */
    public function entity()
    {
        return ScreenConfig::class;
    }
}
