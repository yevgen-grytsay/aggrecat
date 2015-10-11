<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date: 11.10.2015
 */

namespace YevgenGrytsay\Aggrecat;


class CommonAggregate extends AggregateAbstract
{
    /**
     * @param $item
     *
     * @return mixed
     */
    public function item($item)
    {
        $value = $this->accessor->getValue($item);
        $this->result = call_user_func_array($this->aggregateFunction, [$this->result, $value]);
    }
}