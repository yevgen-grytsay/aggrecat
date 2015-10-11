# aggrecat
Small and extensible data aggregation library.

## Short usage example
Calculate sum of "price" field values and group by "dealer" field.
```php
$dealerAccess = new \YevgenGrytsay\Aggrecat\ConstantFieldAccess('dealer');
$partitionByDealer = new \YevgenGrytsay\Aggrecat\ConstantFieldPartition($dealerAccess);

$priceAccess = new \YevgenGrytsay\Aggrecat\ConstantFieldAccess('price');
$sum = new \YevgenGrytsay\Aggrecat\SumFunction();
$sumAggregate = new  \YevgenGrytsay\Aggrecat\CommonAggregate($priceAccess, $sum, 0);
$factory = new \YevgenGrytsay\Aggrecat\AggregateFactory($sumAggregate);
$priceAggregate = new \YevgenGrytsay\Aggrecat\PartitionAggregate($factory, $partitionByDealer);

$data = new ArrayObject(array(
    array('id' => 1, 'dealer' => 4, 'name' => 'Rainbow', 'price' => 10),
    array('id' => 2, 'dealer' => 4, 'name' => 'Six', 'price' => 20),
    array('id' => 3, 'dealer' => 2, 'name' => 'Raven', 'price' => 100),
    array('id' => 4, 'dealer' => 2, 'name' => 'Shield', 'price' => 200),
));
$visitor = new \YevgenGrytsay\Aggrecat\IteratorVisitor();
$aggVisitor = new \YevgenGrytsay\Aggrecat\AggregateVisitor($priceAggregate);
$visitor->accept($data->getIterator(), $aggVisitor);

$result = $priceAggregate->getResult();
var_dump($result);
```

Result:
```
array(2) {
    [4] =>
        int(30)
    [2] =>
        int(300)
}
```

## TODO:
* Add adapter for Symfony Property Access.
* Create builder to hide annoyingly long initialization behind usable interface.
* Review Visitor interface and usage.
