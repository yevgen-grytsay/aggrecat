<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date: 11.10.2015
 */

namespace YevgenGrytsay\Aggrecat;


class AggregateFactory
{
    /**
     * @var AggregateInterface
     */
    private $aggregate;

    /**
     * AggregateFactory constructor.
     *
     * @param AggregateInterface $aggregate
     */
    public function __construct(AggregateInterface $aggregate)
    {
        $this->aggregate = $aggregate;
    }

    /**
     * @return AggregateInterface
     */
    public function create()
    {
        return clone $this->aggregate;
    }
}