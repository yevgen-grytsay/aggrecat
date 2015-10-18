<?php

/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date  : 18.10.2015
 */
class OneValueBuilderAggregateFake extends \YevgenGrytsay\Aggrecat\Builder\BuilderAggregate
{
    /**
     * @var mixed
     */
    private $value;
    /**
     * @var mixed
     */
    private $result;
    /**
     * @var array
     */
    private $aggregateMethodCall = [];

    /**
     * OneValueBuilderAggregateFake constructor.
     *
     * @param mixed $value
     * @param mixed $result
     */
    public function __construct($value, $result)
    {
        $this->value = $value;
        $this->result = $result;
    }

    /**
     * @inheritDoc
     */
    public function addValue(array &$collection, $item)
    {
        $collection[] = $this->value;
    }

    /**
     * @inheritDoc
     */
    public function aggregate($collection)
    {
        $this->aggregateMethodCall = func_get_args();

        return $this->result;
    }

    /**
     * @return array
     */
    public function getAggregateMethodCall()
    {
        return $this->aggregateMethodCall;
    }
}