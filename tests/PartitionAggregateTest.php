<?php

/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 1:14
 */
class PartitionAggregateTest extends PHPUnit_Framework_TestCase
{
    public function testShouldCreateAggregateOnce()
    {
        $factory = $this->createFactoryWithAggregate($this->getMock(\YevgenGrytsay\Aggrecat\AggregateInterface::class));
        $partition = $this->createPartition();
        $aggregate = new \YevgenGrytsay\Aggrecat\PartitionAggregate($factory, $partition);

        $aggregate->item([]);
        $aggregate->item([]);
    }

    public function testShouldCallNestedAggregate()
    {
        $value = new stdClass();
        $nestedAggregate = $this->getMock(\YevgenGrytsay\Aggrecat\AggregateInterface::class);
        $nestedAggregate->expects($this->once())
            ->method('item')
            ->with($value);

        $factory = $this->createFactoryWithAggregate($nestedAggregate);
        $partition = $this->createPartition();
        $aggregate = new \YevgenGrytsay\Aggrecat\PartitionAggregate($factory, $partition);

        $aggregate->item($value);
    }

    /**
     * @param $nestedAggregate
     *
     * @return \YevgenGrytsay\Aggrecat\AggregateFactory
     */
    protected function createFactoryWithAggregate($nestedAggregate)
    {
        $factory = $this->getMockBuilder(\YevgenGrytsay\Aggrecat\AggregateFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $factory->expects($this->once())
            ->method('create')
            ->willReturn($nestedAggregate);

        return $factory;
    }

    /**
     * @param $key
     *
     * @return \YevgenGrytsay\Aggrecat\ConstantFieldPartition
     */
    protected function createPartition($key = 'key')
    {
        $partition = $this->getMock(\YevgenGrytsay\Aggrecat\PartitionInterface::class);
        $partition->expects($this->any())
            ->method('partition')
            ->willReturn($key);

        return $partition;
    }
}
