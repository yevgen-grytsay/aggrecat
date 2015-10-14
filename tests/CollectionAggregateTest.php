<?php
use YevgenGrytsay\Aggrecat\AggregateFunction\FunctionInterface;
use YevgenGrytsay\Aggrecat\PropertyAccess\ConstantAccessInterface;

/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date: 14.10.15
 */
class CollectionAggregateTest extends PHPUnit_Framework_TestCase
{
    public function testShouldInvokeFunctionWithEmptyCollectionWhenEmpty()
    {
        $function = $this->getMock(FunctionInterface::class);
        $function->expects($this->once())
            ->method('__invoke')
            ->with([]);
        $accessor = $this->getMock(ConstantAccessInterface::class);
        $aggregate = new \YevgenGrytsay\Aggrecat\CollectionAggregate($function, $accessor);

        $aggregate->getResult();
    }

    public function testShouldCallAccessor()
    {
        $item = new stdClass();
        $function = $this->getMock(FunctionInterface::class);
        $accessor = $this->getMock(ConstantAccessInterface::class);
        $accessor->expects($this->once())
            ->method('getValue')
            ->with($item);
        $aggregate = new \YevgenGrytsay\Aggrecat\CollectionAggregate($function, $accessor);

        $aggregate->item($item);
    }

    public function testShouldInvokeFunctionWithCollection()
    {
        $function = $this->getMock(FunctionInterface::class);
        $function->expects($this->once())
            ->method('__invoke')
            ->with(['value']);
        $accessor = $this->createAccessorReturning('value');
        $aggregate = new \YevgenGrytsay\Aggrecat\CollectionAggregate($function, $accessor);
        $aggregate->item([]);

        $aggregate->getResult();
    }

    public function testShouldReturnResult()
    {
        $function = $this->getMock(FunctionInterface::class);
        $function->expects($this->once())
            ->method('__invoke')
            ->willReturn('result');
        $accessor = $this->getMock(ConstantAccessInterface::class);
        $aggregate = new \YevgenGrytsay\Aggrecat\CollectionAggregate($function, $accessor);
        $aggregate->item([]);

        $result = $aggregate->getResult();

        $this->assertEquals('result', $result);
    }

    /**
     * @param $value
     * @return ConstantAccessInterface
     */
    protected function createAccessorReturning($value)
    {
        $accessor = $this->getMock(ConstantAccessInterface::class);
        $accessor->expects($this->once())
            ->method('getValue')
            ->willReturn($value);

        return $accessor;
    }
}
