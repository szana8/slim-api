<?php

namespace packages\slim\ItemBuilder\src\Implementations;

use slim\ItemBuilder\Contracts\ItemInterface;
use slim\ItemBuilder\Contracts\ItemBuilderAbstract;

class Date extends ItemBuilderAbstract implements ItemInterface
{
    public static function make($attributes)
    {
        return view('itembuilder::_date', [
            'label'      => $attributes->label,
            'value'      => $attributes->value,
            'name'       => $attributes->name,
            'id'         => $attributes->id,
            'class'      => $attributes->class,
            'attributes' => $attributes->attributes,
        ]);
    }
}
