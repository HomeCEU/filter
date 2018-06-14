<?php declare(strict_types=1);


namespace HomeCEU\Tests;


use HomeCEU\Filter\Criteria;
use HomeCEU\Filter\KeyInterface;

class CriteriaSpy extends Criteria
{
    public function getKey(): KeyInterface
    {
        return $this->key;
    }

    public function getValue()
    {
        return $this->value;
    }
}
