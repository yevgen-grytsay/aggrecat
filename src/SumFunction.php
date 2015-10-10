<?php
/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 0:42
 */

namespace YevgenGrytsay\Aggrecat;


class SumFunction implements AggregateFunctionInterface
{
    /**
     * @param $carry
     * @param $value
     *
     * @return mixed
     */
    public function __invoke($carry, $value)
    {
        $carry += $value;

        return $carry;
    }
}