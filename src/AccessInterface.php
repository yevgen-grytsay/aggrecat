<?php
/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 0:39
 */

namespace YevgenGrytsay\Aggrecat;


interface AccessInterface
{
    /**
     * @param $objectOrArray
     *
     * @return mixed
     */
    public function getValue($objectOrArray);
}