<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date: 14.10.15
 */
require_once __DIR__.'/../vendor/autoload.php';

$priceAccess = new \YevgenGrytsay\Aggrecat\PropertyAccess\ConstantFieldAccess('price');
$function = new \YevgenGrytsay\Aggrecat\AggregateFunction\AverageFunction();
$aggregate = new \YevgenGrytsay\Aggrecat\CollectionAggregate($function, $priceAccess);

$data = new ArrayObject(array(
    array('id' => 1, 'dealer' => 4, 'name' => 'Rainbow', 'price' => 10),
    array('id' => 2, 'dealer' => 4, 'name' => 'Six', 'price' => 20),
    array('id' => 3, 'dealer' => 2, 'name' => 'Raven', 'price' => 100),
    array('id' => 4, 'dealer' => 2, 'name' => 'Shield', 'price' => 200),
));
$visitor = new \YevgenGrytsay\Aggrecat\IteratorVisitor();
$aggVisitor = new \YevgenGrytsay\Aggrecat\AggregateVisitor($aggregate);
$visitor->accept($data->getIterator(), $aggVisitor);

$result = $aggregate->getResult();
var_dump($result);