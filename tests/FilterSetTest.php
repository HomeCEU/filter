<?php declare(strict_types=1);


namespace HomeCEU\Tests;


use PHPUnit\Framework\TestCase;

/**
 * Class CriteriaTest
 *
 * @author  Dan McAdams
 * @package HomeCEU\Tests
 */
class FilterSetTest extends TestCase
{
    const INVALID_PARAMETER_MESSAGE = 'Missing Parameter:';
    public function testNullSring_returnNULL(){

        $this->sendParameters(null, null);
    }

    public function testEmptySring_returnNUL(){
        $this->sendParameters("", null);
    }

    public function testEmptyArray_returnNULL(){
        $this->sendParameters([], null);
    }

    public function testAnyEmptyParameter_returnMessageMissingParameter()
    {
        $this->allParametersEmpty_returnAllParametersKeysAreEmpty();
        $this->keyParameterIsEmpty_returnKeyParameterIsEmpty();
        $this->operandParameterIsEmpty_returnOperandIsEmpty();
        $this->valueParameterIsEmpty_returnValueIsEmpty();
    }

    public function testAllParametersNotEmpty_returnAQuery()
    {
        $parameters = ['key' => 'userId', 'operand' => '>', 'value' => '100'];
        $this->sendParameters($parameters, 'userId > 100');
    }

    public function testFilterSetWithDifferentParameters_returnsValidQuery()
    {
        $filterA = ['key' => 'userId', 'operand' => '>', 'value' => '100'];
        $filterB = ['key' => 'userName', 'operand' => '=', 'value' => 'testname'];
        $query = 'userId > 100 and userName = testname';
        $this->sendFilterSet($query, [$filterA, $filterB]);
    }

    public function testFilterSetWithInvalidParameters_returnMessageMissingParameters()
    {
        $filterA = ['key' => 'CompanyId', 'operand' => '=', 'value' => 'MyComp'];
        $filterB = ['key' => 'address', 'operand' => '', 'value' => '100Apples'];
        $query = SELF::INVALID_PARAMETER_MESSAGE . '["operand"]';
        $this->sendFilterSet($query, [$filterA, $filterB]);
    }

    public function testFilterWithNullTableName_returnsNull()
    {

        $filterA = ['key' => 'user_id', 'operand' => '>', 'value' => '1'];
        $tableName = '';
        $fullQuery = null;

        $this->sendFilterSetWithTableName($fullQuery, [$filterA], $tableName);
    }

    public function testFilterWithTableName_returnsFullSQLValidQuery()
    {

        $filterA = ['key' => 'user_id', 'operand' => '>', 'value' => '1'];
        $tableName = 'User';
        $fullQuery = 'Select * from ' .$tableName . ' where user_id > 1';

        $this->sendFilterSetWithTableName($fullQuery, [$filterA], $tableName);
    }


    public function testMultipleFilterWithTableName_returnsFullSQLValidQuery()
    {

        $filterA = ['key' => 'user_id',     'operand' => '>', 'value' => '1'];
        $filterB = ['key' => 'user_name',   'operand' => '=', 'value' => 'test'];
        $filterC = ['key' => 'user_address','operand' => '=', 'value' => '100Apples'];
        $filterD = ['key' => 'user_email',  'operand' => '=', 'value' => 'tes@test.com'];
        $filterE = ['key' => 'user_phone',  'operand' => '=', 'value' => '1234'];
        $tableName = 'User';
        $fullQuery = 'Select * from User where user_id > 1 and user_name = test and user_address = 100Apples and user_email = tes@test.com and user_phone = 1234';

        $this->sendFilterSetWithTableName(
            $fullQuery,
            [$filterA, $filterB, $filterC, $filterD, $filterE ],
            $tableName);
    }

//
//    public function testConditionsFormation()
//    {
//        $filter = new Filter();
//        //?? what am I testing ???////
//        //$this->assertEquals($fullQuery, $filter->buildQuery($filterSet, $tableName));
//    }

    /**
     * @param $expected
     * @param $queryParameters
     */
    private function sendParameters($queryParameters, $expected): void
    {
        $filter = new Filter();
        $this->assertEquals($expected, $filter->buildConditionSet($queryParameters));
    }

    private function allParametersEmpty_returnAllParametersKeysAreEmpty()
    {
        $parameters = ['key' => '', 'operand' => '', 'value' => ''];
        $this->sendParameters($parameters, SELF::INVALID_PARAMETER_MESSAGE . '["key","operand","value"]');
    }

    private function keyParameterIsEmpty_returnKeyParameterIsEmpty()
    {
        $parameters = ['key' => '', 'operand' => '>', 'value' => '100'];
        $this->sendParameters($parameters, SELF::INVALID_PARAMETER_MESSAGE . '["key"]');
    }

    private function operandParameterIsEmpty_returnOperandIsEmpty()
    {
        $parameters = ['key' => 'userId', 'operand' => '', 'value' => '100'];
        $this->sendParameters($parameters, SELF::INVALID_PARAMETER_MESSAGE . '["operand"]');
    }

    private function valueParameterIsEmpty_returnValueIsEmpty()
    {
        $parameters = ['key' => 'userId', 'operand' => '>', 'value' => ''];
        $this->sendParameters($parameters, SELF::INVALID_PARAMETER_MESSAGE . '["value"]');
    }

    /**
     * @param $query
     * @param $filterSet
     */
    private function sendFilterSet($query, $filterSet): void
    {
        $filter = new Filter();
        $this->assertEquals(
            $query,
            $filter->buildQueryFilter($filterSet));
    }

    /**
     * @param $fullQuery
     * @param $filterSet
     * @param $tableName
     */
    private function sendFilterSetWithTableName($fullQuery, $filterSet, $tableName): void
    {
        $filter = new Filter();
        $this->assertEquals($fullQuery, $filter->buildQuery($filterSet, $tableName));
    }
}
