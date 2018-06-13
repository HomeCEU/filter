<?php declare(strict_types=1);


namespace HomeCEU\Tests;


use HomeCEU\Filter\KeyInterface;

class MockKey implements KeyInterface
{
    protected $type;
    protected $value;

    public function __construct()
    {
        $this->type  = md5(uniqid());
        $this->value = md5(uniqid());
    }

    public function getType()
    {
        return $this->type;
    }

    public function getValue()
    {
        return $this->value;
    }
}
