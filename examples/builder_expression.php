<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date  : 18.10.2015
 */
require_once __DIR__.'/../vendor/autoload.php';

$language = new \Symfony\Component\ExpressionLanguage\ExpressionLanguage();
$expressionEngine = new \YevgenGrytsay\Aggrecat\Expression\SymfonyAdapter($language);
$b = new \YevgenGrytsay\Aggrecat\Builder\Builder($expressionEngine);

$data = new ArrayObject(array(
    array('id' => 1, 'dealer' => 4, 'name' => 'Rainbow', 'price' => 10, 'quantity' => 10),
    array('id' => 2, 'dealer' => 4, 'name' => 'Six', 'price' => 20, 'quantity' => 15),
    array('id' => 3, 'dealer' => 2, 'name' => 'Raven', 'price' => 100, 'quantity' => 70),
    array('id' => 4, 'dealer' => 2, 'name' => 'Shield', 'price' => 200, 'quantity' => 5),
));

$function = new \YevgenGrytsay\Aggrecat\AggregateFunction\AverageFunction();
$b->addAggregate('avg_price', $function, 'price');

$dealerAccess = new \YevgenGrytsay\Aggrecat\PropertyAccess\ConstantFieldAccess('dealer');
$partitionByDealer = new \YevgenGrytsay\Aggrecat\ConstantFieldPartition($dealerAccess);
$b->addAggregate('avg_price_by_dealer', $function, 'price * quantity', $partitionByDealer);
$result = $b->run($data->getIterator());

var_dump($result);