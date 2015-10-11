<?php
/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 0:40
 */

namespace YevgenGrytsay\Aggrecat;


abstract class AggregateAbstract implements AggregateInterface
{
    /**
     * @var ConstantAccessInterface
     */
    protected $accessor;
    /**
     * @var AggregateFunctionInterface
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
     * @param AggregateFunctionInterface $aggregateFunction
     * @param $initValue
     */
    public function __construct(ConstantAccessInterface $accessor, AggregateFunctionInterface $aggregateFunction, $initValue)
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
    abstract public function item($item);
}