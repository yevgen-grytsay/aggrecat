<?php
/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 0:37
 */

namespace YevgenGrytsay\Aggrecat;


interface VisitorInterface
{
    /**
     * @param $item
     *
     * @return mixed
     */
    public function visit($item);
}