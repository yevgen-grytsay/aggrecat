<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date: 11.10.2015
 */

namespace YevgenGrytsay\Aggrecat;


class ConstantFieldAccess implements ConstantAccessInterface
{
    /**
     * @var
     */
    protected $field;

    /**
     * ArrayFieldAccess constructor.
     *
     * @param $field
     */
    public function __construct($field)
    {
        $this->field = $field;
    }

    /**
     * @param $objectOrArray
     *
     * @return mixed
     */
    public function getValue($objectOrArray)
    {
        return $objectOrArray[$this->field];
    }
}