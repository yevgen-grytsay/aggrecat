<?php

/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 1:26
 */
class AggregateFunctionMock implements \YevgenGrytsay\Aggrecat\AggregateFunctionInterface
{
    /**
     * @var array
     */
    protected $valueHistory = [];
    /**
     * @param $carry
     * @param $value
     *
     * @return mixed
     */
    public function __invoke($carry, $value)
    {
        $this->valueHistory[] = $value;
    }

    /**
     * @return array
     */
    public function getValueHistory()
    {
        return $this->valueHistory;
    }
}