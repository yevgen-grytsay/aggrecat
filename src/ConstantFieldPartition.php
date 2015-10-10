<?php
/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 0:41
 */

namespace YevgenGrytsay\Aggrecat;


class ConstantFieldPartition implements PartitionInterface
{
    /**
     * @var AccessInterface
     */
    protected $accessor;

    /**
     * PartitionByField constructor.
     *
     * @param AccessInterface $accessor
     */
    public function __construct(AccessInterface $accessor)
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