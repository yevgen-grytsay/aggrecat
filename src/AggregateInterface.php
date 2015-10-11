<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date: 11.10.2015
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