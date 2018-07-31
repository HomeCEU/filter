<?php declare(strict_types=1);


namespace HomeCEU\Tests;


use HomeCEU\Filter\Key;
use HomeCEU\Filter\Value;
use PHPUnit\Framework\TestCase;

/**
 * Class CriteriaTest
 *
 * @author  Dan McAdams
 * @package HomeCEU\Tests
 */
class CriteriaTest extends TestCase
{
    public function testGetKey()
    {
        $key      = new MockKey();
        $criteria = new CriteriaSpy($key, new Value('made up'));

        $this->assertEquals($key, $criteria->getKey());
    }

    public function testGetValue()
    {
        $valueArg = 'some value';

        $key   = new MockKey();
        $value = new Value($valueArg);

        $criteria = new CriteriaSpy($key, $value);
        $this->assertEquals($value, $criteria->getValue());
    }
}
