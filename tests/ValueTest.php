<?php declare(strict_types=1);


namespace HomeCEU\Tests;


use HomeCEU\Filter\Value;
use PHPUnit\Framework\TestCase;

/**
 * Class ValueTest
 *
 * @author  Dan McAdams
 * @package HomeCEU\Tests
 */
class ValueTest extends TestCase
{
    public function testGetValue()
    {
        $valueText = 'some value';
        $value     = new Value($valueText);

        $this->assertEquals($valueText, $value->getValue());
    }
}
