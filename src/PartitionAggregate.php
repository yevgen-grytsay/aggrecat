<?php
/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 0:41
 */

namespace YevgenGrytsay\Aggrecat;


class PartitionAggregate implements AggregateInterface
{
    /**
     * @var PartitionInterface
     */
    private $partition;

    /**
     * @var AggregateInterface[]
     */
    private $nested = [];
    /**
     * @var AggregateFactory
     */
    private $factory;

    /**
     * @param AggregateFactory $factory
     * @param PartitionInterface $partition
     */
    public function __construct(AggregateFactory $factory, PartitionInterface $partition)
    {
        $this->partition = $partition;
        $this->factory = $factory;
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    public function item($item)
    {
        $key = $this->partition->partition($item);
        $this->initPartition($key);
        $this->nested[$key]->item($item);
    }

    /**
     * @param $key
     */
    protected function initPartition($key)
    {
        if (!array_key_exists($key, $this->nested)) {
            $this->nested[$key] = $this->factory->create();
        }
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return array_map(function(AggregateInterface $item) {
            return $item->getResult();
        }, $this->nested);
    }
}