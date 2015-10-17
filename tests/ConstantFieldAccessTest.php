<?php
use YevgenGrytsay\Aggrecat\PropertyAccess\ConstantFieldAccess;

/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date  : 18.10.2015
 */
class ConstantFieldAccessTest extends PHPUnit_Framework_TestCase
{
    public function testShouldAccessSpecifiedField()
    {
        $object = $this->getMock(ArrayAccess::class);
        $object->expects($this->once())
            ->method('offsetGet')
            ->with('field');
        $accessor = new ConstantFieldAccess('field');

        $accessor->getValue($object);
    }

    public function testShouldReturnValue()
    {
        $object = $this->getMock(ArrayAccess::class);
        $object->expects($this->once())
            ->method('offsetGet')
            ->willReturn('value');
        $accessor = new ConstantFieldAccess('field');

        $value = $accessor->getValue($object);

        $this->assertEquals('value', $value);
    }
}
