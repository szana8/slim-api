<?php

namespace slim\ItemBuilder\Implementations;

use slim\ItemBuilder\Contracts\ItemInterface;
use slim\ItemBuilder\Contracts\ItemBuilderAbstract;

class Checkbox extends ItemBuilderAbstract implements ItemInterface
{
    public static function make($attributes)
    {
        return view('itembuilder::_checkbox', [
            'label'      => $attributes->label,
            'value'      => $attributes->value,
            'name'       => $attributes->name,
            'id'         => $attributes->id,
            'class'      => '',
            'attributes' => $attributes->attributes,
        ]);
    }
}
