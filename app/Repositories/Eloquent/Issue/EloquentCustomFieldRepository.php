<?php

namespace App\Repositories\Eloquent\Issue;


use App\Repositories\RepositoryAbstract;
use App\Eloquent\Admin\Issue\CustomField;
use App\Repositories\Contracts\Issue\CustomFieldRepository;

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