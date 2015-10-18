<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date: 11.10.2015
 */

namespace YevgenGrytsay\Aggrecat;


interface AggregateInterface
{
    /**
     * @param array $data
     *
     * @return mixed
     */
    public function aggregate(array $data = []);
}