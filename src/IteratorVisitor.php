<?php
/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 0:38
 */

namespace YevgenGrytsay\Aggrecat;


class IteratorVisitor
{
    /**
     * @param \Iterator $data
     * @param VisitorInterface $visitor
     */
    public function accept(\Iterator $data, VisitorInterface $visitor)
    {
        foreach ($data as $item) {
            $visitor->visit($item);
        }
    }
}