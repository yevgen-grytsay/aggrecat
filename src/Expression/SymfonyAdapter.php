<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date  : 18.10.2015
 */

namespace YevgenGrytsay\Aggrecat\Expression;


use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class SymfonyAdapter implements ExpressionInterface
{
    /**
     * @var ExpressionLanguage
     */
    protected $language;

    /**
     * SymfonyAdapter constructor.
     *
     * @param ExpressionLanguage $language
     */
    public function __construct(ExpressionLanguage $language)
    {
        $this->language = $language;
    }

    /**
     * @param $expression
     * @param array $values
     *
     * @return string
     */
    public function evaluate($expression, array $values = [])
    {
        return $this->language->evaluate($expression, $values);
    }
}