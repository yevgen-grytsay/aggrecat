<?php
/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 0:42
 */
use YevgenGrytsay\Aggrecat\AggregateFunction\AverageFunction;
use YevgenGrytsay\Aggrecat\Builder\Builder;
use YevgenGrytsay\Aggrecat\ConstantFieldPartition;
use YevgenGrytsay\Aggrecat\Expression\PropertyAccessExpression;
use YevgenGrytsay\Aggrecat\PropertyAccess\ConstantFieldAccess;

require_once __DIR__.'/../vendor/autoload.php';

$accessEngine = new PropertyAccessExpression();
$b = new Builder($accessEngine);

$data = new ArrayObject(array(
    array('id' => 1, 'dealer' => 4, 'name' => 'Rainbow', 'price' => 10),
    array('id' => 2, 'dealer' => 4, 'name' => 'Six', 'price' => 20),
    array('id' => 3, 'dealer' => 2, 'name' => 'Raven', 'price' => 100),
    array('id' => 4, 'dealer' => 2, 'name' => 'Shield', 'price' => 200),
));

$function = new AverageFunction();
$dealerAccess = new ConstantFieldAccess('dealer');
$partitionByDealer = new ConstantFieldPartition($dealerAccess);
$b->addAggregate('avg_price_by_dealer', $function, 'price', $partitionByDealer);
$result = $b->run($data->getIterator());

var_dump($result);