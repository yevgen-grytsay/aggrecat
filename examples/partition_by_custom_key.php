<?php
/**
 * Created by PhpStorm.
 * User: yevgen
 * Date: 23.01.16
 * Time: 20:17
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
    array('id' => 1, 'date' => '2016-01-23 18:25:00', 'name' => 'Rainbow', 'price' => 10),
    array('id' => 2, 'date' => '2016-01-23 18:45:00', 'name' => 'Six', 'price' => 20),
    array('id' => 3, 'date' => '2016-01-23 19:15:00', 'name' => 'Raven', 'price' => 100),
    array('id' => 4, 'date' => '2016-01-23 20:50:00', 'name' => 'Shield', 'price' => 200),
));
/**
 * Setup partition
 */
$dateAccess = new ConstantFieldAccess('date');
$partitionByDate = new ConstantFieldPartition($dateAccess, function ($dateStr) {
    $date = \DateTime::createFromFormat('Y-m-d H:i:s', $dateStr);

    return $date->format('Y-m-d H:00:00');
});
/**
 * Setup aggregation
 */
$priceAccess = new ConstantFieldAccess('price');
$sum = new SumFunction();
$sumAggregate = new ReduceAggregate($priceAccess, $sum, 0);
$factory = new AggregateFactory($sumAggregate);
$priceAggregate = new PartitionAggregate($factory, $partitionByDate);
/**
 * Run
 */
$visitor = new IteratorVisitor();
$aggVisitor = new AggregateVisitor($priceAggregate);
$visitor->accept($data->getIterator(), $aggVisitor);

$result = $priceAggregate->getResult();
var_dump($result);