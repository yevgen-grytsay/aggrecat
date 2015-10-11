<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date: 11.10.2015
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