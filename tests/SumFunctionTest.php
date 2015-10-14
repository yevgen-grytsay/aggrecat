<?php

/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 1:11
 */
class SumFunctionTest extends PHPUnit_Framework_TestCase
{
    public function testShouldAdd()
    {
        $sum = new \YevgenGrytsay\Aggrecat\ReduceFunction\SumFunction();

        $result = $sum->__invoke(0, 2);

        $this->assertEquals(2, $result);
    }
}
