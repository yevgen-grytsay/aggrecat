<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date: 11.10.2015
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
    public function __invoke($carry, $value);
}