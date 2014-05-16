<?php
namespace Shrikeh\Precision\Calculator;

use \Shrikeh\Precision\Number;
use \Shrikeh\Precision\Calculator\Rounder;

interface CalculatorEngine
{
    public function validate(array $numbers);

    public function add(Number $number, Number $addend, Rounder $rounder);
}
