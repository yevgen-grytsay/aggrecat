<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date: 11.10.2015
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