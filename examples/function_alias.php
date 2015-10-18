<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date  : 18.10.2015
 */
use YevgenGrytsay\Aggrecat\AggregateFunction\FunctionInterface;

require_once __DIR__.'/../vendor/autoload.php';

class SumFunction implements FunctionInterface
{
    /**
     * @param array $items
     *
     * @return mixed
     */
    public function __invoke(array $items)
    {
        return array_sum($items);
    }
}

define('FUNCTION_SUM', 'sum');
define('FUNCTION_AVG', 'avg');
$functionProvider = new \YevgenGrytsay\Aggrecat\Builder\FunctionProvider([
    FUNCTION_AVG => new \YevgenGrytsay\Aggrecat\AggregateFunction\AverageFunction(),
    FUNCTION_SUM => new SumFunction()
]);
$data = new ArrayObject(array(
    array('id' => 1, 'dealer' => 4, 'name' => 'Rainbow', 'price' => 10, 'quantity' => 10),
    array('id' => 2, 'dealer' => 4, 'name' => 'Six', 'price' => 20, 'quantity' => 15),
    array('id' => 3, 'dealer' => 2, 'name' => 'Raven', 'price' => 100, 'quantity' => 70),
    array('id' => 4, 'dealer' => 1, 'name' => 'Shield', 'price' => 200, 'quantity' => 5),
));

$language = new \Symfony\Component\ExpressionLanguage\ExpressionLanguage();
$expressionEngine = new \YevgenGrytsay\Aggrecat\Expression\SymfonyAdapter($language);
$b = new \YevgenGrytsay\Aggrecat\Builder\Builder($expressionEngine, $functionProvider);

$b->addAggregate('total_price', FUNCTION_SUM, 'price * quantity');

$dealerAccess = new \YevgenGrytsay\Aggrecat\PropertyAccess\ConstantFieldAccess('dealer');
$partitionByDealer = new \YevgenGrytsay\Aggrecat\ConstantFieldPartition($dealerAccess);
$b->addAggregate('avg_price_by_dealer', FUNCTION_AVG, 'price * quantity', $partitionByDealer);
$result = $b->run($data->getIterator());

var_dump($result);