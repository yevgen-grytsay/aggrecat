<?php
/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 0:41
 */

namespace YevgenGrytsay\Aggrecat;


interface PartitionInterface
{
    /**
     * @param $item
     *
     * @return mixed Partition key
     */
    public function partition($item);
}