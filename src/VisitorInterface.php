<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date: 11.10.2015
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