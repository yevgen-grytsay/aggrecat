<?php

/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 1:14
 */
class PartitionAggregateTest extends PHPUnit_Framework_TestCase
{
    public function testShouldCallAggregateFunctionWithProperArguments()
    {
        $value = 'value';
        $field = $this->createFieldAccessorStub($value);
        $partition = $this->createPartition();
        $function = new AggregateFunctionMock();

        $agg = new \YevgenGrytsay\Aggrecat\PartitionAggregate($field, $function, $partition, 0);
        $agg->item([]);

        $valueList = $function->getValueHistory();
        $this->assertEquals([$value], $valueList);
    }

    public function testAggregateResultShouldContainProperKeyAndValue()
    {
        $value = 'value';
        $key = 'key';
        $field = $this->createFieldAccessorStub($value);
        $partition = $this->createPartition($key);
        $function = new ConcatAggregateFunction();

        $agg = new \YevgenGrytsay\Aggrecat\PartitionAggregate($field, $function, $partition, '');
        $agg->item([]);

        $result = $agg->getResult();
        $this->assertEquals([$key => $value], $result);
    }

    /**
     * @param $value
     *
     * @return \YevgenGrytsay\Aggrecat\ConstantAccessInterface
     */
    protected function createFieldAccessorStub($value)
    {
        $field = $this->getMockBuilder('\YevgenGrytsay\Aggrecat\ConstantAccessInterface')
            ->getMock();
        $field->expects($this->any())
            ->method('getValue')
            ->willReturn($value);

        return $field;
    }

    /**
     * @param $key
     *
     * @return \YevgenGrytsay\Aggrecat\ConstantFieldPartition
     */
    protected function createPartition($key = null)
    {
        $partition = $this->getMock(\YevgenGrytsay\Aggrecat\PartitionInterface::class);
        $partition->expects($this->any())
            ->method('partition')
            ->willReturn($key);

        return $partition;
    }
}
