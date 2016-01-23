<?php
use YevgenGrytsay\Aggrecat\ConstantFieldPartition;

/**
 * Created by PhpStorm.
 * User: yevgen
 * Date: 23.01.16
 * Time: 21:03
 */
class ConstantFieldPartitionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataSet
     *
     * @param $exception
     * @param $transformer
     */
    public function testShouldAcceptOnlyCallableAsTransformer($exception, $transformer)
    {
        if ($exception) {
            $this->setExpectedException('\RuntimeException');
        }
        new ConstantFieldPartition($this->createAccessor(), $transformer);
    }

    /**
     * @return \YevgenGrytsay\Aggrecat\PropertyAccess\ConstantAccessInterface
     */
    private function createAccessor()
    {
        $accessor = $this->getMock('\YevgenGrytsay\Aggrecat\PropertyAccess\ConstantAccessInterface');

        return $accessor;
    }

    public function dataSet()
    {
        return array(
            array(true, ''),
            array(true, 1),
            array(false, null),
            array(false, function(){}),
            array(false, 'trim'),
        );
    }
}
