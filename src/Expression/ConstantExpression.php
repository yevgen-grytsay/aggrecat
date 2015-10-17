<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date  : 18.10.2015
 */

namespace YevgenGrytsay\Aggrecat\Expression;

/**
 * Each time invoked evaluates the same expression.
 *
 * Class ConstantExpression
 * @package YevgenGrytsay\Aggrecat\Expression
 */
class ConstantExpression implements ConstantExpressionInterface
{
    /**
     * @var string
     */
    private $expression;
    /**
     * @var ExpressionInterface
     */
    private $engine;

    /**
     * ConstantExpression constructor.
     *
     * @param string $expression
     * @param ExpressionInterface $engine
     */
    public function __construct($expression, ExpressionInterface $engine)
    {
        $this->expression = $expression;
        $this->engine = $engine;
    }

    /**
     * @param array $values
     *
     * @return mixed
     */
    public function evaluate($values = [])
    {
        return $this->engine->evaluate($this->expression, $values);
    }
}