<?php
namespace Shrikeh\Precision\Calculator;

use \Shrikeh\Precision\Calculator\Calculation\Binary;

class CalculationFactory
{
    public function calculation(\Closure $calculation)
    {
        return new Binary($calculation);
    }
}
