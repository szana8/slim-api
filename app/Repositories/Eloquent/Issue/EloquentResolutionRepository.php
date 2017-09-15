<?php

namespace App\Repositories\Eloquent\Issue;

use App\Repositories\RepositoryAbstract;
use App\Eloquent\Admin\Issue\IssueResolution;
use App\Repositories\Contracts\Issue\ResolutionRepository;

class EloquentResolutionRepository extends RepositoryAbstract implements ResolutionRepository
{
    /**
     * Create GeneralSettings entity.
     *
     * @return GeneralSetting
     */
    public function entity()
    {
        return IssueResolution::class;
    }
}