<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date: 14.10.15
 */

namespace YevgenGrytsay\Aggrecat\AggregateFunction;


class AverageFunction implements FunctionInterface
{
    /**
     * @param array $items
     * @return mixed
     */
    public function __invoke(array $items)
    {
        $result = 0;
        $count = count($items);
        if ($count > 0) {
            $sum = array_sum($items);
            $result = $sum / $count;
        }

        return $result;
    }
}