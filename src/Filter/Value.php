<?php declare(strict_types=1);


namespace HomeCEU\Filter;

/**
 * Class Value
 *
 * @author  Dan McAdams
 * @package HomeCEU\Filter
 */
class Value implements ValueInterface
{
    /**
     * @var
     */
    protected $value;

    /**
     * Value constructor.
     *
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
