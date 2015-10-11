<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date: 11.10.2015
 */

namespace YevgenGrytsay\Aggrecat;


interface ConstantAccessInterface
{
    /**
     * @param $objectOrArray
     *
     * @return mixed
     */
    public function getValue($objectOrArray);
}