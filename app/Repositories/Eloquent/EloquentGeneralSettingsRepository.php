<?php

namespace App\Repositories\Eloquent;

use App\Eloquent\Admin\GeneralSetting;
use App\Repositories\Contracts\GeneralSettingsRepository;
use App\Repositories\RepositoryAbstract;

class EloquentGeneralSettingsRepository extends RepositoryAbstract implements GeneralSettingsRepository
{
    /**
     * Create GeneralSettings entity.
     *
     * @return GeneralSetting
     */
    public function entity()
    {
        return GeneralSetting::class;
    }
}
