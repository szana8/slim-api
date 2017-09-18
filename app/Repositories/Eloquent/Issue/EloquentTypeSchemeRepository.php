<?php

namespace App\Repositories\Eloquent\Issue;

use App\Eloquent\Admin\Issue\IssueTypeSchema;
use App\Repositories\Contracts\Issue\TypeSchemeRepository;
use App\Repositories\RepositoryAbstract;

class EloquentTypeSchemeRepository extends RepositoryAbstract implements TypeSchemeRepository
{
    /**
     * Create Permission entity.
     *
     * @return string
     */
    public function entity()
    {
        return IssueTypeSchema::class;
    }
}
