<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date  : 18.10.2015
 */

namespace YevgenGrytsay\Aggrecat\Expression;


interface ConstantExpressionInterface
{
    /**
     * @param array $values
     *
     * @return mixed
     */
    public function evaluate(array $values = []);
}