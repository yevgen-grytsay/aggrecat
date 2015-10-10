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
        $sum = new \YevgenGrytsay\Aggrecat\SumFunction();
        $result = 0;

        $sum->__invoke($result, 1);

        $this->assertEquals(1, $result);
    }
}
