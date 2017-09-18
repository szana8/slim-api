<?php

namespace App\Repositories\Eloquent\Issue;

use App\Repositories\RepositoryAbstract;
use App\Eloquent\Admin\Issue\IssueTypeSchema;
use App\Repositories\Contracts\Issue\TypeSchemeRepository;

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
