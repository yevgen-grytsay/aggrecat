<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date  : 18.10.2015
 */

namespace YevgenGrytsay\Aggrecat\Expression;


use YevgenGrytsay\Aggrecat\PropertyAccess\ConstantFieldAccess;

class PropertyAccessExpression implements ExpressionInterface
{
    /**
     * @param $expression
     * @param array $values
     *
     * @return mixed
     * TODO: implement caching
     */
    public function evaluate($expression, array $values = [])
    {
        $accessor = new ConstantFieldAccess($expression);

        return $accessor->getValue($values);
    }
}