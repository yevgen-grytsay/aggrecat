<?php
use YevgenGrytsay\Aggrecat\Builder\Builder;
use YevgenGrytsay\Aggrecat\Builder\BuilderAggregate;
use YevgenGrytsay\Aggrecat\Expression\ExpressionInterface;

/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date  : 18.10.2015
 */
class BuilderTest extends PHPUnit_Framework_TestCase
{
    public function testShouldCallAddValueWithProperArguments()
    {
        $iterator = $this->createIterator(['item1']);
        $expressionEngine = $this->getMock(ExpressionInterface::class);
        $builder = new Builder($expressionEngine);
        $aggregate = $this->getMockBuilder(BuilderAggregate::class)
            ->disableOriginalConstructor()
            ->getMock();
        $aggregate->expects($this->once())
            ->method('addValue')
            ->with([], 'item1');
        $builder->addAggregateObject('name', $aggregate);

        $builder->run($iterator);
    }

    public function testShouldCallAggregateWithProperArguments()
    {
        $iterator = $this->createIterator([null]);
        $expressionEngine = $this->getMock(ExpressionInterface::class);
        $builder = new Builder($expressionEngine);
        $aggregate = new OneValueBuilderAggregateFake('value1', null);
        $builder->addAggregateObject('name', $aggregate);

        $builder->run($iterator);

        $collection = current($aggregate->getAggregateMethodCall());
        $this->assertEquals(['value1'], $collection);
    }

    public function testReturnResult()
    {
        $iterator = $this->createIterator([null]);
        $expressionEngine = $this->getMock(ExpressionInterface::class);
        $builder = new Builder($expressionEngine);
        $aggregate = new OneValueBuilderAggregateFake(null, 'result');
        $builder->addAggregateObject('name', $aggregate);

        $result = $builder->run($iterator);

        $this->assertEquals(['name' => 'result'], $result);
    }


    /**
     * @param array $items
     *
     * @return ArrayIterator
     */
    private function createIterator(array $items = [])
    {
        $data = new ArrayObject($items);

        return $data->getIterator();
    }
}
