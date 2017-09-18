<?php

namespace App\Repositories\Eloquent\Issue;

use App\Eloquent\Admin\Issue\IssueType;
use App\Repositories\RepositoryAbstract;
use App\Repositories\Contracts\Issue\TypeRepository;

class EloquentTypeRepository extends RepositoryAbstract implements TypeRepository
{
    /**
     * Create GeneralSettings entity.
     *
     * @return GeneralSetting
     */
    public function entity()
    {
        return IssueType::class;
    }
}
