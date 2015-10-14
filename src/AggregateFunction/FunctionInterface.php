<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date: 14.10.15
 */

namespace YevgenGrytsay\Aggrecat\AggregateFunction;


interface FunctionInterface
{
    /**
     * @param array $items
     * @return mixed
     */
    public function __invoke(array $items);
}