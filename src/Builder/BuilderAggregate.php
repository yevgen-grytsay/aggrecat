<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date  : 18.10.2015
 */

namespace YevgenGrytsay\Aggrecat\Builder;


use YevgenGrytsay\Aggrecat\Aggregate;
use YevgenGrytsay\Aggrecat\AggregateFunction\FunctionInterface;
use YevgenGrytsay\Aggrecat\AggregateInterface;
use YevgenGrytsay\Aggrecat\Expression\ConstantExpressionInterface;
use YevgenGrytsay\Aggrecat\PartitionedAggregate;
use YevgenGrytsay\Aggrecat\PartitionInterface;

class BuilderAggregate
{
    /**
     * @var ConstantExpressionInterface
     */
    protected $expression;
    /**
     * @var AggregateInterface
     */
    protected $aggregate;
    /**
     * @var PartitionInterface|null
     */
    protected $partition;

    /**
     * Aggregate constructor.
     *
     * @param ConstantExpressionInterface $expression
     * @param FunctionInterface $function
     * @param null|PartitionInterface $partition
     */
    public function __construct(ConstantExpressionInterface $expression, FunctionInterface $function, PartitionInterface $partition = null)
    {
        $this->expression = $expression;
        $this->partition = $partition;
        if ($partition) {
            $this->aggregate = new PartitionedAggregate($function);
        } else {
            $this->aggregate = new Aggregate($function);
        }
    }

    /**
     * @param array $collection
     * @param mixed $item
     */
    public function addValue(array &$collection, $item)
    {
        $value = $this->expression->evaluate($item);
        if ($this->partition) {
            $key = $this->partition->partition($item);
            if (!array_key_exists($key, $collection)) {
                $collection[$key] = [];
            }
            $collection[$key][] = $value;
        } else {
            $collection[] = $value;
        }
    }

    /**
     * @param $collection
     *
     * @return mixed
     */
    public function aggregate($collection)
    {
        return $this->aggregate->aggregate($collection);
    }
}