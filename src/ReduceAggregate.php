<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date: 11.10.2015
 */

namespace YevgenGrytsay\Aggrecat;


use YevgenGrytsay\Aggrecat\PropertyAccess\ConstantAccessInterface;
use YevgenGrytsay\Aggrecat\ReduceFunction\ReduceFunctionInterface;

class ReduceAggregate implements AggregateInterface
{
    /**
     * @var ConstantAccessInterface
     */
    protected $accessor;
    /**
     * @var ReduceFunctionInterface
     */
    protected $aggregateFunction;
    /**
     * @var
     */
    protected $result;

    /**
     * DefaultAggregate constructor.
     *
     * @param ConstantAccessInterface $accessor
     * @param ReduceFunctionInterface $aggregateFunction
     * @param $initValue
     */
    public function __construct(ConstantAccessInterface $accessor, ReduceFunctionInterface $aggregateFunction, $initValue)
    {
        $this->accessor = $accessor;
        $this->aggregateFunction = $aggregateFunction;
        $this->result = $initValue;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

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