# aggrecat
Small and extensible data aggregation library.

## Short usage example
* Calculate average value of "price" field.
* Calculate average value of expression 'price * quantity' for each row and group by "dealer" field.
```php
$language = new \Symfony\Component\ExpressionLanguage\ExpressionLanguage();
$expressionEngine = new \YevgenGrytsay\Aggrecat\Expression\SymfonyAdapter($language);
$b = new \YevgenGrytsay\Aggrecat\Builder\Builder($expressionEngine);

$data = new ArrayObject(array(
    array('dealer' => 4, 'price' => 10, 'quantity' => 10),
    array('dealer' => 4, 'price' => 20, 'quantity' => 15),
    array('dealer' => 2, 'price' => 100, 'quantity' => 70),
    array('dealer' => 2, 'price' => 200, 'quantity' => 5),
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
For more examples see "examples" folder.