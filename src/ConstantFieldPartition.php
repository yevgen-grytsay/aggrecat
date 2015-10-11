<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date: 11.10.2015
 */

namespace YevgenGrytsay\Aggrecat;


class ConstantFieldPartition implements PartitionInterface
{
    /**
     * @var ConstantAccessInterface
     */
    protected $accessor;

    /**
     * PartitionByField constructor.
     *
     * @param ConstantAccessInterface $accessor
     */
    public function __construct(ConstantAccessInterface $accessor)
    {
        $this->accessor = $accessor;
    }

    /**
     * @param $item
     *
     * @return mixed Partition key
     */
    public function partition($item)
    {
        return $this->accessor->getValue($item);
    }
}