<?php
require_once __DIR__ . '/../vendor/autoload.php';

$container = new Shrikeh\Precision\Precision();

$calculator = $container['calculator'];


$number = $calculator(23);

$multiply = $calculator(7);

$result = $number->multiply($multiply);

echo $result;

$zero = $calculator(0);

echo $result->compare($zero);
