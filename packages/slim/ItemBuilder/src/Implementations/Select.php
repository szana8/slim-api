<?php

namespace slim\ItemBuilder\Implementations;

use slim\ItemBuilder\Contracts\ItemBuilderAbstract;
use slim\ItemBuilder\Contracts\ItemInterface;

class Select extends ItemBuilderAbstract implements ItemInterface
{
    public static function make($attributes)
    {
        return view('itembuilder::_select', [
            'label'      => $attributes->label,
            'value'      => $attributes->value,
            'name'       => $attributes->name,
            'id'         => $attributes->id,
            'class'      => $attributes->class,
            'attributes' => $attributes->attributes,
            'options'    => $attributes->options,
        ]);
    }
}
