<?php
require_once __DIR__ . '/../vendor/autoload.php';

$container = new Shrikeh\Precision\Precision();

$calc = $container['calculator'];

$number = $calc(23);

$multiply = $calc(7.9756);

$result = $number->multiply($multiply);

echo "$result\n"; // will print out 183.43

$calc->setDefaultScale(4);

$result = $number->multiply($multiply);

echo "$result\n"; // will print out 183.4388

$calc->setDefaultScale(3);

$result = $number->multiply($multiply);

echo "$result\n"; // will print out 183.439

$zero = $calc(0);

$compare = $result->compare($zero);
echo "$compare\n";

