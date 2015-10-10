<?php
/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 0:40
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