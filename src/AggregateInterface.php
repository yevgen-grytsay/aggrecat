<?php
/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 0:38
 */

namespace YevgenGrytsay\Aggrecat;


interface AggregateInterface
{
    /**
     * @param $item
     *
     * @return mixed
     */
    public function item($item);

    /**
     * @return mixed
     */
    public function getResult();
}