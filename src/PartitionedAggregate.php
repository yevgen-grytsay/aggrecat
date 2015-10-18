<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date  : 18.10.2015
 */

namespace YevgenGrytsay\Aggrecat;


use YevgenGrytsay\Aggrecat\AggregateFunction\FunctionInterface;

class PartitionedAggregate implements AggregateInterface
{
    /**
     * @var FunctionInterface
     */
    private $function;

    /**
     * Aggregate constructor.
     *
     * @param FunctionInterface $function
     */
    public function __construct(FunctionInterface $function)
    {
        $this->function = $function;
    }

    /**
     * @param array $data
     *
     * @return mixed
     * @internal param $item
     *
     */
    public function aggregate(array $data = [])
    {
        $result = [];
        foreach ($data as $name => $partition) {
            $result[$name] = call_user_func($this->function, $partition);
        }

        return $result;
    }
}