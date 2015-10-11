<?php
/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 0:41
 */

namespace YevgenGrytsay\Aggrecat;


class PartitionAggregate extends AggregateAbstract
{
    /**
     * @var PartitionInterface
     */
    protected $partition;
    /**
     * @var
     */
    private $initValue;

    /**
     * @param ConstantAccessInterface $accessor
     * @param AggregateFunctionInterface $aggregateFunction
     * @param PartitionInterface $partition
     * @param $initValue
     */
    public function __construct(ConstantAccessInterface $accessor, AggregateFunctionInterface $aggregateFunction, PartitionInterface $partition, $initValue)
    {
        parent::__construct($accessor, $aggregateFunction, []);
        $this->initValue = $initValue;
        $this->partition = $partition;
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    public function item($item)
    {
        $value = $this->accessor->getValue($item);
        $key = $this->partition->partition($item);
        $this->initPartition($key);
        $this->result[$key] = call_user_func_array($this->aggregateFunction, [$this->result[$key], $value]);
    }

    /**
     * @param $key
     */
    protected function initPartition($key)
    {
        if (!array_key_exists($key, $this->result)) {
            $this->result[$key] = $this->initValue;
        }
    }
}