<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date  : 18.10.2015
 */

namespace YevgenGrytsay\Aggrecat\Builder;


use YevgenGrytsay\Aggrecat\AggregateFunction\FunctionInterface;
use YevgenGrytsay\Aggrecat\Expression\ConstantExpression;
use YevgenGrytsay\Aggrecat\Expression\ConstantExpressionInterface;
use YevgenGrytsay\Aggrecat\Expression\ExpressionInterface;
use YevgenGrytsay\Aggrecat\PartitionInterface;

class Builder
{
    /**
     * @var array
     */
    protected $aggregateMap = [];
    /**
     * @var ExpressionInterface
     */
    protected $expressionEngine;

    /**
     * Builder constructor.
     *
     * @param ExpressionInterface $expressionEngine
     */
    public function __construct(ExpressionInterface $expressionEngine)
    {
        $this->expressionEngine = $expressionEngine;
    }

    /**
     * @param string $name
     * @param FunctionInterface $function
     * @param ConstantExpressionInterface|string $expression
     * @param PartitionInterface|null $partition
     */
    public function addAggregate($name, FunctionInterface $function, $expression, PartitionInterface $partition = null)
    {
        if (array_key_exists($name, $this->aggregateMap)) {
            throw new \RuntimeException(sprintf('Aggregate with name "%s" already exists.', $name));
        }

        if (!$expression instanceof ConstantExpressionInterface && !is_string($expression)) {
            throw new \RuntimeException(sprintf(
                'Wrong expression parameter type. Expected "%s" or "string", got "%s".',
                ExpressionInterface::class, gettype($name)));
        }
        if (is_string($expression)) {
            $expression = new ConstantExpression($expression, $this->expressionEngine);
        }

        $this->aggregateMap[$name] = new BuilderAggregate($expression, $function, $partition);
    }

    /**
     * @param \Iterator $data
     *
     * @return array
     */
    public function run(\Iterator $data)
    {
        $collected = array_fill_keys(array_keys($this->aggregateMap), []);
        foreach ($data as $item) {
            /**
             * @var string $name
             * @var BuilderAggregate $aggregate
             */
            foreach ($this->aggregateMap as $name => $aggregate) {
                $aggregate->addValue($collected[$name], $item);
            }
        }

        $aggregateResult = array_fill_keys(array_keys($this->aggregateMap), null);
        /**
         * @var string $name
         * @var BuilderAggregate $aggregate
         */
        foreach ($this->aggregateMap as $name => $aggregate) {
            $aggregateResult[$name] = $aggregate->aggregate($collected[$name]);
        }

        return $aggregateResult;
    }
}