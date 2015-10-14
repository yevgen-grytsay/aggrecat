<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date: 14.10.15
 */

namespace YevgenGrytsay\Aggrecat;


use YevgenGrytsay\Aggrecat\AggregateFunction\FunctionInterface;
use YevgenGrytsay\Aggrecat\PropertyAccess\ConstantAccessInterface;

class CollectionAggregate implements AggregateInterface
{
    /**
     * @var array
     */
    protected $collection = array();
    /**
     * @var FunctionInterface
     */
    protected $function;
    /**
     * @var ConstantAccessInterface
     */
    protected $accessor;

    /**
     * CollectionAggregate constructor.
     * @param FunctionInterface $function
     * @param ConstantAccessInterface $accessor
     */
    public function __construct(FunctionInterface $function, ConstantAccessInterface $accessor)
    {
        $this->function = $function;
        $this->accessor = $accessor;
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    public function item($item)
    {
        $this->collection[] = $this->accessor->getValue($item);
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return call_user_func_array($this->function, [$this->collection]);
    }
}