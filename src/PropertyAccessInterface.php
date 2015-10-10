<?php
/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 0:39
 */

namespace YevgenGrytsay\Aggrecat;


interface PropertyAccessInterface
{
    /**
     * @param $objectOrArray
     * @param $field
     *
     * @return mixed
     */
    public function getValue($objectOrArray, $field);
}