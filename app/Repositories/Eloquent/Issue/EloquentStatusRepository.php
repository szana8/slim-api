<?php

namespace App\Repositories\Eloquent\Issue;


use App\Eloquent\Admin\Issue\IssueStatus;
use App\Repositories\Contracts\Issue\StatusRepository;
use App\Repositories\RepositoryAbstract;

class EloquentStatusRepository extends RepositoryAbstract implements StatusRepository
{
    /**
     * Create GeneralSettings entity.
     *
     * @return GeneralSetting
     */
    public function entity()
    {
        return IssueStatus::class;
    }
}