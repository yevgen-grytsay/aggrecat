<?php

/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 1:35
 */
class ConcatAggregateFunction implements \YevgenGrytsay\Aggrecat\ReduceFunction\ReduceFunctionInterface
{
    /**
     * @param $carry
     * @param $value
     *
     * @return mixed
     */
    public function __invoke($carry, $value)
    {
        $carry .= $value;

        return $carry;
    }
}