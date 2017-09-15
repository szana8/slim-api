<?php

namespace App\Repositories\Eloquent\Criteria;

use App\Repositories\Criteria\CriterionInterface;

class EagerLoad implements CriterionInterface
{
    /**
     * @var array
     */
    protected $relations;

    /**
     * EagerLoad constructor.
     *
     * @param array $relations
     */
    public function __construct(array $relations)
    {
        $this->relations = $relations;
    }

    /**
     * Apply the eager load.
     *
     * @param $entity
     *
     * @return mixed
     */
    public function apply($entity)
    {
        return $entity->with($this->relations);
    }
}
