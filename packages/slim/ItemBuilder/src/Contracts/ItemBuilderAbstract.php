<?php

namespace slim\ItemBuilder\Contracts;

abstract class ItemBuilderAbstract
{
    /**
     * @param array $options
     *
     * @return bool|null|string
     */
    protected static function generateAttributes($options = [])
    {
        if (empty($options)) {
            return false;
        }

        $attributes = null;

        foreach ($options as $key => $value) {
            $attributes .= $key.' = '.$value.' ';
        }

        return $attributes;
    }

    /**
     * @param $array
     *
     * @return \stdClass
     */
    protected static function array_to_object($array)
    {
        $object = new \stdClass();
        foreach ($array as $key => $value) {
            if (strlen($key)) {
                if (is_array($value)) {
                    $object->{$key} = self::array_to_object($value); //RECURSION
                } else {
                    $object->{$key} = $value;
                }
            }
        }

        return $object;
    }
}
