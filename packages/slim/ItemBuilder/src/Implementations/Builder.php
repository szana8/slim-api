<?php

namespace slim\ItemBuilder\Implementations;

use slim\ItemBuilder\Contracts\ItemBuilderAbstract;

class Builder extends ItemBuilderAbstract
{
    /**
     * @var
     */
    protected $item;

    /**
     * @var
     */
    protected $items;

    /**
     * @var
     */
    protected $attributes;

    /**
     * @var
     */
    protected $collection;

    /**
     * Builder constructor.
     *
     * @param $collection
     */
    public function __construct($collection)
    {
        $this->collection = $collection;
        $this->item = new \stdClass();
    }

    /**
     * @return object
     */
    public function collect()
    {
        foreach ($this->collection as $key => $value) {
            $this->setAttributes($value, $key);
            $this->items[$key] = $this->add();
        }
        $this->items = (object) $this->items;

        return $this->items;
    }

    /**
     * @return mixed
     *
     * @internal param $type
     * @internal param $attributes
     */
    public function add()
    {
        return call_user_func(['slim\ItemBuilder\Implementations\\'.ucfirst($this->attributes->type), 'make'], $this->attributes);
    }

    /**
     * @param $attributes
     * @param $name
     *
     * @return mixed
     */
    protected function setAttributes($attributes, $name)
    {
        $this->item->id = isset($attributes['id']) ?: $this->id();
        $this->item->rows = isset($attributes['rows']) ? $attributes['rows'] : 3;
        $this->item->name = isset($attributes['name']) ? $attributes['name'] : $name;
        $this->item->type = isset($attributes['type']) ? $attributes['type'] : 'text';
        $this->item->value = isset($attributes['value']) ? $attributes['value'] : null;
        $this->item->options = isset($attributes['options']) ? $attributes['options'] : null;
        $this->item->class = isset($attributes['class']) ? $attributes['class'] : 'form-control';
        $this->item->label = isset($attributes['label']) ? $attributes['label'] : ucfirst($name);
        $this->item->attributes = isset($attributes['attributes']) ? self::generateAttributes($attributes['attributes']) : null;

        $this->attributes = self::array_to_object($this->item);
    }

    /**
     * Generate an integer identifier for each new item.
     *
     * @return int
     */
    protected function id()
    {
        return uniqid(rand());
    }

    /**
     * Generate an integer identifier for each new item.
     *
     * @return int
     */
    protected function name()
    {
        return $this->id();
    }
}
