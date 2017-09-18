<?php

namespace App\Repositories\Eloquent\Issue;

use App\Eloquent\Admin\Issue\IssueType;
use App\Repositories\Contracts\Issue\TypeRepository;
use App\Repositories\RepositoryAbstract;

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
