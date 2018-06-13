<?php

namespace HomeCEU\Filter;

/**
 * Interface ValueInterface
 *
 * Filter\Value is a class for passing a value to a filter,
 * the value can be of any type.
 *
 * @package HomeCEU\Filter
 */
interface ValueInterface
{
    /**
     * @return mixed
     */
    public function getValue();
}
