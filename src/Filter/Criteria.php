<?php declare(strict_types=1);


namespace HomeCEU\Filter;

/**
 * Class Criteria
 *
 * Also known as the "Filter"
 *
 * Contains a key, a value, and a set of operations/comparison operators
 *
 * @author  Dan McAdams
 * @package HomeCEU\Filter
 */
class Criteria
{
    /**
     * @var KeyInterface
     */
    protected $key;

    /**
     * @var ValueInterface
     */
    protected $value;

    /**
     * Criteria constructor.
     *
     * @param KeyInterface $key
     */
    public function __construct(KeyInterface $key, ValueInterface $value)
    {
        $this->key   = $key;
        $this->value = $value;
    }
}
