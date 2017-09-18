<?php

namespace App\Repositories;

use App\Repositories\Criteria\CriteriaInterface;
use App\Repositories\Exceptions\NoEntityDefined;
use App\Repositories\Contracts\RepositoryInterface;

abstract class RepositoryAbstract implements RepositoryInterface, CriteriaInterface
{
    /**
     * Repository object entity.
     *
     * @var mixed Object entity property
     */
    protected $entity;

    /**
     * RepositoryAbstract constructor.
     */
    public function __construct()
    {
        $this->entity = $this->resolveEntity();
    }

    /**
     * Return all records of the entity.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {
        return $this->entity->get();
    }

    /**
     * Find a record by id in the entity.
     *
     * @param $id       Primary key value of the object
     *
     * @return mixed Collection of the affected entity
     */
    public function find($id)
    {
        return $this->entity->findOrFail($id);
    }

    /**
     * Find a record by the default searchByKeyword function.
     *
     * @param $keyword  String what you want to find
     *
     * @return mixed Collection of the affected entity
     */
    public function search($keyword)
    {
        return $this->entity->searchByKeyword($keyword);
    }

    /**
     * Find a record by a column.
     *
     * @param $column   Column name
     * @param $value    Value what you want to find
     *
     * @return mixed Collection of the affected entity
     */
    public function findWhere($column, $value)
    {
        return $this->entity->where($column, $value);
    }

    /**
     * Find the first record.
     *
     * @param $column   Column name
     * @param $value    Value what you want to find
     *
     * @return mixed Collection of the affected entity
     */
    public function findWhereFirst($column, $value)
    {
        return $this->entity->where($column, $value)->firstOrFail();
    }

    /**
     * Find the records which are in the id array.
     *
     * @param $column           Column name
     * @param array $values Array of values
     *
     * @return mixed Collection of the affected entity
     */
    public function findWhereIn($column, array $values)
    {
        return $this->entity->whereIn($column, $values)->get();
    }

    /**
     * Find the records which are in the id array.
     *
     * @param $column           Column name
     * @param array $values Array of values
     *
     * @return mixed Collection of the affected entity
     */
    public function findWhereNotIn($column, array $values)
    {
        return $this->entity->whereNotIn($column, $values)->get();
    }

    /**
     * Group the records by column in the entity.
     *
     * @param $column   Column name
     *
     * @return mixed Collection of the affected entity
     */
    public function groupBy($column)
    {
        return $this->entity->groupBy($column)->get();
    }

    /**
     * Find a record by id in the entity.
     *
     * @param $column       Column name
     * @param string $type Order by type asc/desc
     *
     * @return mixed Collection of the affected entity
     */
    public function orderBy($column, $type = 'desc')
    {
        return $this->entity->orderBy($column, $type)->get();
    }

    /**
     * Create a pagination if needed.
     *
     * @param int $perPage Number of records per page
     *
     * @return mixed Collection of the affected entity
     */
    public function paginate($perPage = 10)
    {
        return $this->entity->paginate($perPage);
    }

    /**
     * Create function of the entity.
     *
     * @param array $properties Properties of the entity
     *
     * @return mixed Collection of the affected entity
     */
    public function create(array $properties)
    {
        return $this->entity->create($properties);
    }

    /**
     * Update an entity with the proper values.
     *
     * @param $id                   Primary key
     * @param array $properties Property of the entity
     *
     * @return mixed Collection of the affected entity
     */
    public function update($id, array $properties)
    {
        return $this->entity->findOrFail($id)->update($properties);
    }

    /**
     * Update an entity with the proper values.
     *
     * @param $id                   Primary key
     * @param array $properties Property of the entity
     *
     * @return mixed Update an entity with the proper values
     */
    public function fill($id, array $properties)
    {
        $entity = $this->entity->findOrFail($id)->fill($properties);

        return ($entity->update()) ? $entity : false;
    }

    /**
     * Delete an entity.
     *
     * @param $id               Primary key
     *
     * @return mixed Collection of the affected entity
     */
    public function delete($id)
    {
        return $this->entity->findOrFail($id)->delete();
    }

    /**
     * Eager load the entity with the proper objects.
     *
     * @param array ...$criteria Criteria object
     *
     * @return $this Collection of the affected entity
     */
    public function withCriteria(...$criteria)
    {
        $criteria = array_flatten($criteria);

        foreach ($criteria as $criterion) {
            $this->entity = $criterion->apply($this->entity);
        }

        return $this;
    }

    /**
     * Eager load the entity with custom where clause.
     *
     * @param $eagerLoad    Object what you want to eager load
     * @param $column       Column of the join
     * @param $value        Value of the join
     *
     * @return mixed Collection of the affected entity
     */
    public function whereHas($eagerLoad, $column, $value)
    {
        return $this->entity->whereHas($eagerLoad, function ($q) use ($column, $value) {
            $q->where($column, '=', $value);
        });
    }

    /**
     * Create an object entity if not exists.
     *
     * @throws NoEntityDefined
     *
     * @return mixed Collection of the affected entity
     */
    protected function resolveEntity()
    {
        if (! method_exists($this, 'entity')) {
            throw new NoEntityDefined('No entity defined');
        }

        return app()->make($this->entity());
    }
}
