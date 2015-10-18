<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date  : 18.10.2015
 */
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use YevgenGrytsay\Aggrecat\AggregateFunction\AverageFunction;
use YevgenGrytsay\Aggrecat\AggregateFunction\SumFunction;
use YevgenGrytsay\Aggrecat\Builder\Builder;
use YevgenGrytsay\Aggrecat\Builder\FunctionProvider;
use YevgenGrytsay\Aggrecat\ConstantFieldPartition;
use YevgenGrytsay\Aggrecat\Expression\SymfonyAdapter;
use YevgenGrytsay\Aggrecat\PropertyAccess\ConstantFieldAccess;

require_once __DIR__.'/../vendor/autoload.php';


define('FUNCTION_SUM', 'sum');
define('FUNCTION_AVG', 'avg');
$functionProvider = new FunctionProvider([
    FUNCTION_AVG => new AverageFunction(),
    FUNCTION_SUM => new SumFunction()
]);
$data = new ArrayObject(array(
    array('id' => 1, 'dealer' => 4, 'price' => 10, 'quantity' => 10),
    array('id' => 2, 'dealer' => 4, 'price' => 20, 'quantity' => 15),
    array('id' => 3, 'dealer' => 2, 'price' => 100, 'quantity' => 70),
    array('id' => 3, 'dealer' => 2, 'price' => 5.8, 'quantity' => 1),
    array('id' => 4, 'dealer' => 1, 'price' => 200, 'quantity' => 5),
));

$language = new ExpressionLanguage();
$expressionEngine = new SymfonyAdapter($language);
$b = new Builder($expressionEngine, $functionProvider);

$b->addAggregate('total_price', FUNCTION_SUM, 'price * quantity');

$dealerAccess = new ConstantFieldAccess('dealer');
$partitionByDealer = new ConstantFieldPartition($dealerAccess);
$b->addAggregate('avg_price_by_dealer', FUNCTION_AVG, 'price * quantity', $partitionByDealer);
$result = $b->run($data->getIterator());

var_dump($result);