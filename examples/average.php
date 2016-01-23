<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date: 14.10.15
 */
use YevgenGrytsay\Aggrecat\AggregateFunction\AverageFunction;
use YevgenGrytsay\Aggrecat\AggregateVisitor;
use YevgenGrytsay\Aggrecat\CollectionAggregate;
use YevgenGrytsay\Aggrecat\IteratorVisitor;
use YevgenGrytsay\Aggrecat\PropertyAccess\ConstantFieldAccess;

require_once __DIR__.'/../vendor/autoload.php';

$priceAccess = new ConstantFieldAccess('price');
$function = new AverageFunction();
$aggregate = new CollectionAggregate($function, $priceAccess);

$data = new ArrayObject(array(
    array('id' => 1, 'dealer' => 4, 'name' => 'Rainbow', 'price' => 10),
    array('id' => 2, 'dealer' => 4, 'name' => 'Six', 'price' => 20),
    array('id' => 3, 'dealer' => 2, 'name' => 'Raven', 'price' => 100),
    array('id' => 4, 'dealer' => 2, 'name' => 'Shield', 'price' => 200),
));
$visitor = new IteratorVisitor();
$aggVisitor = new AggregateVisitor($aggregate);
$visitor->accept($data->getIterator(), $aggVisitor);

$result = $aggregate->getResult();
var_dump($result);