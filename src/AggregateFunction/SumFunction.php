<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date  : 18.10.2015
 */

namespace YevgenGrytsay\Aggrecat\AggregateFunction;


class SumFunction implements FunctionInterface
{
    /**
     * @param array $items
     * @return mixed
     */
    public function __invoke(array $items)
    {
        return array_sum($items);
    }
}