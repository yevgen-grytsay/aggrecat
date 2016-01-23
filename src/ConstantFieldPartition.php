<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date: 11.10.2015
 */

namespace YevgenGrytsay\Aggrecat;


use YevgenGrytsay\Aggrecat\PropertyAccess\ConstantAccessInterface;

class ConstantFieldPartition implements PartitionInterface
{
    /**
     * @var ConstantAccessInterface
     */
    protected $accessor;
    /**
     * @var callable/\Closure
     */
    private $transformer;

    /**
     * PartitionByField constructor.
     *
     * @param ConstantAccessInterface $accessor
     * @param callable $transformer
     * @throws \RuntimeException
     */
    public function __construct(ConstantAccessInterface $accessor, $transformer = null)
    {
        if($transformer !== null && !is_callable($transformer)) {
            throw new \RuntimeException('Transformer must be callable.');
        }
        $this->accessor = $accessor;
        $this->transformer = $transformer;
    }

    /**
     * @param $item
     *
     * @return mixed Partition key
     */
    public function partition($item)
    {
        $value = $this->accessor->getValue($item);
        $value = $this->transform($value);

        return $value;
    }

    /**
     * @param $value
     * @return mixed
     */
    private function transform($value)
    {
        if ($this->transformer) {
            $value = call_user_func_array($this->transformer, [$value]);
        }

        return $value;
    }
}