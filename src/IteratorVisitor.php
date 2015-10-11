<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date: 11.10.2015
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