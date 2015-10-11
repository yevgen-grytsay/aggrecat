<?php
/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 0:39
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