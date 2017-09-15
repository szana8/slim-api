<?php

namespace slim\ItemBuilder;

use slim\ItemBuilder\Implementations\Builder;

class ItemBuilder
{
    /**
     * @var
     */
    protected $items;

    /**
     * @param $name
     * @param array $collection
     *
     * @return object
     */
    public function make($name, array $collection)
    {
        $builder = new Builder($collection);
        $this->items = $builder->collect();

        \View::share($name, $this->items);

        return $this->items;
    }
}
