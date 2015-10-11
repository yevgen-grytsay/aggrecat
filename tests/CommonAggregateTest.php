<?php

/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 11:15
 */
class CommonAggregateTest extends PHPUnit_Framework_TestCase
{
    public function testShouldCarry()
    {
        $accessor = $this->createAccessorConstantValue('constant value');
        $function = $this->getMock(\YevgenGrytsay\Aggrecat\AggregateFunctionInterface::class);
        $function->expects($this->at(0))
            ->method('__invoke')
            ->with('initial', 'constant value')
            ->willReturn('result');

        $function->expects($this->at(1))
            ->method('__invoke')
            ->with('result', 'constant value');

        $agg = new \YevgenGrytsay\Aggrecat\CommonAggregate($accessor, $function, 'initial');

        $agg->item([]);
        $agg->item([]);
    }

    /**
     * @param $value
     *
     * @return \YevgenGrytsay\Aggrecat\ConstantAccessInterface
     */
    protected function createAccessorConstantValue($value)
    {
        $accessor = $this->getMock(\YevgenGrytsay\Aggrecat\ConstantAccessInterface::class);
        $accessor->expects($this->any())
            ->method('getValue')
            ->willReturn($value);

        return $accessor;
    }
}
