<?php
namespace Shrikeh\Precision\Calculator;

use \Shrikeh\Precision\Calculator\Calculation\ClosureCalculation;

class CalculationFactory
{
    public function calculation(\Closure $calculation)
    {
        return new ClosureCalculation($calculation);
    }
}
