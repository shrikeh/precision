<?php
require_once __DIR__ . '/../vendor/autoload.php';

$di = new Pimple();

$di['calculator'] = function($c) {
    return new \Shrikeh\Precision\Calculator\BCMath();
};

$calculator = $di['calculator'];

$number = $calculator(23);

var_dump(bccomp(1, 1.1, 1));



