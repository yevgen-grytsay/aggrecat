<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date: 11.10.2015
 */

namespace YevgenGrytsay\Aggrecat;


class AggregateVisitor implements VisitorInterface
{
    /**
     * @var AggregateInterface
     */
    protected $aggregate;

    /**
     * AggregateVisitor constructor.
     *
     * @param AggregateInterface $aggregate
     */
    public function __construct(AggregateInterface $aggregate)
    {
        $this->aggregate = $aggregate;
    }

    /**
     * @param $item
     *
     * @return mixed
     */
    public function visit($item)
    {
        $this->aggregate->item($item);
    }
}