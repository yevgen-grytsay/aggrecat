<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date  : 18.10.2015
 */

namespace YevgenGrytsay\Aggrecat\Builder;


use YevgenGrytsay\Aggrecat\AggregateFunction\FunctionInterface;

class FunctionProvider
{
    /**
     * @var FunctionInterface[]
     */
    protected $aliasMap = [];

    /**
     * FunctionProvider constructor.
     *
     * @param \YevgenGrytsay\Aggrecat\AggregateFunction\FunctionInterface[] $aliasMap
     */
    public function __construct(array $aliasMap = [])
    {
        array_walk($aliasMap, function(FunctionInterface $fnc) {});
        $this->aliasMap = $aliasMap;
    }

    /**
     * @param $alias
     * @param FunctionInterface $function
     * @param bool|false $override
     */
    public function addFunction($alias, FunctionInterface $function, $override = false)
    {
        if (!$override && array_key_exists($alias, $this->aliasMap)) {
            throw new \RuntimeException('Function alias "%s" already registered.', $alias);
        }
        $this->aliasMap[$alias] = $function;
    }

    /**
     * @param $alias
     *
     * @return FunctionInterface
     */
    public function getFunction($alias)
    {
        if (!array_key_exists($alias, $this->aliasMap)) {
            throw new \RuntimeException(sprintf('Function with alias "%s" not found.', $alias));
        }

        return $this->aliasMap[$alias];
    }
}