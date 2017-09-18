<?php

namespace App\Repositories\Eloquent\Criteria;

use App\Repositories\Criteria\CriterionInterface;

class EagerLoadWithCriteria implements CriterionInterface
{
    /**
     * @var array
     */
    protected $relation;
    /**
     * @var
     */
    protected $column;
    /**
     * @var
     */
    protected $value;

    /**
     * EagerLoad constructor.
     *
     * @param $relation
     * @param $column
     * @param $value
     */
    public function __construct($relation, $column, $value)
    {
        $this->relation = $relation;
        $this->column = $column;
        $this->value = $value;
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
        $column = $this->column;
        $value = $this->value;

        return $entity->with([$this->relation => function ($query) use ($column, $value) {
            $query->where($column, '=', $value)->distinct();
        }]);
    }
}
