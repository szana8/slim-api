<?php

namespace slim\ItemBuilder\Contracts;

interface ItemInterface
{
    public static function make($attributes);
}
