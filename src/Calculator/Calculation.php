<?php
namespace Shrikeh\Precision\Calculator;

use \Shrikeh\Precision\Calculator\Rounder;

interface Calculation
{
    public function calculate(Rounder $rounder);
}
