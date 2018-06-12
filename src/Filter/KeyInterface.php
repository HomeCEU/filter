<?php

namespace HomeCEU\Filter;


/**
 * Class Key
 *
 * @author  Dan McAdams
 * @package HomeCEU\Filter
 */
interface KeyInterface
{
    /**
     * @return null|string
     */
    public function getType();

    /**
     * @return string
     */
    public function getValue();
}
