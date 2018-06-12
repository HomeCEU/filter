<?php declare(strict_types=1);


namespace HomeCEU\Tests;


use HomeCEU\Filter\Key;
use PHPUnit\Framework\TestCase;

/**
 * Class KeyTest
 *
 * @author  Dan McAdams
 * @package HomeCEU\Tests
 */
class KeyTest extends TestCase
{
    public function testGetKey()
    {
        $testKey = 'test_key';
        $key     = new Key($testKey);

        $this->assertEquals($testKey, $key->getValue());
    }

    public function testSetEmptyKey()
    {
        $testType = 'test_type';
        $testKey  = '';

        $this->expectException(\InvalidArgumentException::class);
        new Key($testKey, $testType);
    }

    public function testGetType()
    {
        $testType = 'test_type';
        $testKey  = 'test_key';
        $key      = new Key($testKey, $testType);

        $this->assertEquals($testType, $key->getType());
    }
}
