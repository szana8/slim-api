<?php

namespace App\Repositories\Eloquent\Issue;

use App\Eloquent\Admin\Issue\CustomField;
use App\Repositories\Contracts\Issue\CustomFieldRepository;
use App\Repositories\RepositoryAbstract;

class EloquentCustomFieldRepository extends RepositoryAbstract implements CustomFieldRepository
{
    /**
     * Create GeneralSettings entity.
     *
     * @return GeneralSetting
     */
    public function entity()
    {
        return CustomField::class;
    }
}
