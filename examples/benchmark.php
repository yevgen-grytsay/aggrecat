<?php
/**
 * @author: Yevgen Grytsay <yevgen_grytsay@mail.ru>
 * @date  : 18.10.2015
 */

require_once __DIR__.'/../vendor/autoload.php';

/**
 * Test data
 */
$itemNumber = 1000;
$faker = \Faker\Factory::create();
$data = new ArrayObject();
foreach (range(1, $itemNumber) as $i) {
    $data->append([
        'dealer' => $faker->randomDigitNotNull,
        'price' => $faker->randomFloat(),
        'quantity' => $faker->numberBetween(0, 100)
    ]);
}

/**
 * Aggregator initialization
 */
$language = new \Symfony\Component\ExpressionLanguage\ExpressionLanguage();
$expressionEngine = new \YevgenGrytsay\Aggrecat\Expression\SymfonyAdapter($language);
$b = new \YevgenGrytsay\Aggrecat\Builder\Builder($expressionEngine);

$function = new \YevgenGrytsay\Aggrecat\AggregateFunction\AverageFunction();
$b->addAggregate('avg_price', $function, 'price');

$dealerAccess = new \YevgenGrytsay\Aggrecat\PropertyAccess\ConstantFieldAccess('dealer');
$partitionByDealer = new \YevgenGrytsay\Aggrecat\ConstantFieldPartition($dealerAccess);
$b->addAggregate('avg_price_by_dealer', $function, 'price * quantity', $partitionByDealer);

/**
 * Run
 */
echo 'Begin', PHP_EOL;
$timeStart = microtime(true);
$result = $b->run($data->getIterator());
$timeEnd = microtime(true);

var_dump($result);
echo 'Took (sec): ', ($timeEnd - $timeStart), PHP_EOL;
echo 'Memory peak usage (Mb): ', round(memory_get_peak_usage(true)/1024/1024, 2), PHP_EOL;

/*
 * My results (Windows, PHP 5.6.3)
 *
 * 10^2 - 0.05 sec
 * 10^3 - 0.49 sec
 * 10^4 - 3.84 sec
 * 10^5 - 44 sec
 */