<?php
use YevgenGrytsay\Aggrecat\Expression\ConstantExpression;
use YevgenGrytsay\Aggrecat\Expression\ExpressionInterface;

/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date  : 18.10.2015
 */
class ConstantExpressionTest extends PHPUnit_Framework_TestCase
{
    public function testShouldCallEvaluateWithProperParameters()
    {
        $mock = $this->getMock(ExpressionInterface::class);
        $mock->expects($this->once())
            ->method('evaluate')
            ->with('expression', ['one']);

        $expression = new ConstantExpression('expression', $mock);

        $expression->evaluate(['one']);
    }

    public function testShouldReturnValue()
    {
        $mock = $this->getMock(ExpressionInterface::class);
        $mock->expects($this->once())
            ->method('evaluate')
            ->willReturn('result');
        $expression = new ConstantExpression('expression', $mock);

        $result = $expression->evaluate(['one']);

        $this->assertEquals('result', $result);
    }
}
