<?php
/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 0:39
 */

namespace YevgenGrytsay\Aggrecat;


interface AggregateFunctionInterface
{
    /**
     * @param $carry
     * @param $value
     *
     * @return mixed
     */
    public function __invoke(&$carry, $value);
}