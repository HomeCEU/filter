<?php declare(strict_types=1);


namespace HomeCEU\Filter;

/**
 * Class Key
 *
 * @author  Dan McAdams
 * @package HomeCEU\Filter
 */
class Key implements KeyInterface
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var null|string
     */
    protected $type;

    /**
     * Key constructor.
     *
     * @param string $key
     * @param string $type
     */
    public function __construct(string $key, string $type = '')
    {
        if (empty($key)) {
            throw new \InvalidArgumentException('key cannot be empty');
        }

        $this->type = !empty($type) ? $type : null;
        $this->key  = $key;
    }

    /**
     * @return null|string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->key;
    }
}
