<?php
/**
 * Created by PhpStorm.
 * User: Yevgen
 * Date: 11.10.2015
 * Time: 0:42
 */
use YevgenGrytsay\Aggrecat\AggregateFactory;
use YevgenGrytsay\Aggrecat\AggregateVisitor;
use YevgenGrytsay\Aggrecat\ConstantFieldPartition;
use YevgenGrytsay\Aggrecat\IteratorVisitor;
use YevgenGrytsay\Aggrecat\PartitionAggregate;
use YevgenGrytsay\Aggrecat\PropertyAccess\ConstantFieldAccess;
use YevgenGrytsay\Aggrecat\ReduceAggregate;
use YevgenGrytsay\Aggrecat\ReduceFunction\SumFunction;

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Setup data
 */
$data = new ArrayObject(array(
    array('id' => 1, 'dealer' => 4, 'name' => 'Rainbow', 'price' => 10),
    array('id' => 2, 'dealer' => 4, 'name' => 'Six', 'price' => 20),
    array('id' => 3, 'dealer' => 2, 'name' => 'Raven', 'price' => 100),
    array('id' => 4, 'dealer' => 2, 'name' => 'Shield', 'price' => 200),
));
/**
 * Setup partition
 */
$dealerAccess = new ConstantFieldAccess('dealer');
$partitionByDealer = new ConstantFieldPartition($dealerAccess);
/**
 * Setup aggregation
 */
$priceAccess = new ConstantFieldAccess('price');
$sum = new SumFunction();
$sumAggregate = new ReduceAggregate($priceAccess, $sum, 0);
$factory = new AggregateFactory($sumAggregate);
$priceAggregate = new PartitionAggregate($factory, $partitionByDealer);
/**
 * Run
 */
$visitor = new IteratorVisitor();
$aggVisitor = new AggregateVisitor($priceAggregate);
$visitor->accept($data->getIterator(), $aggVisitor);
$result = $priceAggregate->getResult();
var_dump($result);