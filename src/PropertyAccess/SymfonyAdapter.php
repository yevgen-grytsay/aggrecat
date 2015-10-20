<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date  : 18.10.2015
 */

namespace YevgenGrytsay\Aggrecat\PropertyAccess;


use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

class SymfonyAdapter implements PropertyAccessInterface
{
    /**
     * @var PropertyAccessorInterface
     */
    protected $accessor;

    /**
     * SymfonyAdapter constructor.
     *
     * @param PropertyAccessorInterface $accessor
     */
    public function __construct(PropertyAccessorInterface $accessor)
    {
        $this->accessor = $accessor;
    }

    /**
     * @param $objectOrArray
     * @param $field
     *
     * @return mixed
     * @throws \RuntimeException
     */
    public function getValue($objectOrArray, $field)
    {
        try {
            return $this->accessor->getValue($objectOrArray, $field);
        } catch (\Exception $e) {
            throw new \RuntimeException(sprintf('Can not get value of field "%s"', $field), 0, $e);
        }
    }
}