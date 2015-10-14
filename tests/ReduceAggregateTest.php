<?php

/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 11:15
 */
class ReduceAggregateTest extends PHPUnit_Framework_TestCase
{
    public function testShouldCarry()
    {
        $accessor = $this->createAccessorConstantValue('constant value');
        $function = $this->getMock(\YevgenGrytsay\Aggrecat\ReduceFunction\ReduceFunctionInterface::class);
        $function->expects($this->at(0))
            ->method('__invoke')
            ->with('initial', 'constant value')
            ->willReturn('result');

        $function->expects($this->at(1))
            ->method('__invoke')
            ->with('result', 'constant value');

        $agg = new \YevgenGrytsay\Aggrecat\ReduceAggregate($accessor, $function, 'initial');

        $agg->item([]);
        $agg->item([]);
    }

    /**
     * @param $value
     *
     * @return \YevgenGrytsay\Aggrecat\PropertyAccess\ConstantAccessInterface
     */
    protected function createAccessorConstantValue($value)
    {
        $accessor = $this->getMock(\YevgenGrytsay\Aggrecat\PropertyAccess\ConstantAccessInterface::class);
        $accessor->expects($this->any())
            ->method('getValue')
            ->willReturn($value);

        return $accessor;
    }
}
