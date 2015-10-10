<?php
/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 0:38
 */

namespace YevgenGrytsay\Aggrecat;


class AggregateVisitor implements VisitorInterface
{
    /**
     * @var \AggregateInterface
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