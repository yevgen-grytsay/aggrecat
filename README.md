# aggrecat
Small and extensible data aggregation library.

## Short usage example
Calculate sum of "price" field values and group by "dealer" field.
```php
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
```

Result:
```
array(2) {
  'avg_price' =>
  double(82.5)
  'avg_price_by_dealer' =>
  array(2) {
    [4] =>
    int(200)
    [2] =>
    int(4000)
  }
}
```

## TODO:
* Create builder to hide annoyingly long initialization behind usable interface.
* Review Visitor interface and usage.
