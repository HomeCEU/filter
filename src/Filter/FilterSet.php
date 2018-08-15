<?php
/**
 * Created by PhpStorm.
 * User: hceudev
 * Date: 8/15/18
 * Time: 3:56 PM
 */

namespace HomeCEU\Filter;



class FilterSet {

    const INVALID_PARAMETER_MESSAGE = 'Missing Parameter:';
    private $invalidParameters;

    public function buildConditionSet($parameters){
        if(!empty($parameters)){
            $this->findMissingParameters($parameters);
            return  $this->getQuerySet($parameters);
        }
        return null;
    }

    public function buildQueryFilter($filterSet)
    {
        $querySets = [];
        foreach ($filterSet as $filter)
        {
            $queryFilter = $this->buildConditionSet($filter);
            $querySets = $this->getQuerySets($queryFilter, $querySets);
        }
        return implode(' and ', $querySets);
    }

    public function buildQuery($filterSet, $table)
    {
        if(empty($table))
        {
            return null;
        }
        $querySets = $this->buildQueryFilter($filterSet);
        $query = 'Select * from '. $table .' where ';
        $sql = $query. $querySets;
        return $sql;
    }

    /**
     * take whatever Dan will pass and transform to call buildQuery
     */
    public function extractSets()
    {


    }

    /**
     * @param $queryFilter
     * @param $querySet
     * @return array
     */
    private function getQuerySets($queryFilter, $querySet): array
    {
        if (!empty($this->invalidParameters)) {
            return    [$this->getInvalidFieldsMessage()];
        }
        $querySet[] = $queryFilter;
        return $querySet;
    }

    /**
     * @param $parameters
     * @return string
     */
    private function getQuerySet($parameters)
    {
        if (!empty($this->invalidParameters)) {
            return $this->getInvalidFieldsMessage();
        }
        return  $parameters['key']      . ' ' .
            $parameters['operand']  . ' ' .
            $parameters['value'];
    }

    /**
     * @param $parameters
     */
    private function findMissingParameters($parameters): void
    {
        foreach ($parameters as $key => $value) {
            if (empty($value)) {
                $this->invalidParameters[] = $key;
            }
        }
    }

    /**
     * @return string
     */
    private function getInvalidFieldsMessage(): string
    {
        return SELF::INVALID_PARAMETER_MESSAGE . json_encode($this->invalidParameters, true);
    }
}