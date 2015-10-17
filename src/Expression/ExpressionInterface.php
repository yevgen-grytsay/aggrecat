<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date  : 18.10.2015
 */

namespace YevgenGrytsay\Aggrecat\Expression;


interface ExpressionInterface
{
//    public function compile($expression);

    public function evaluate($expression, $values = []);
}