<?php
namespace Shrikeh\Precision\Number;

use \Shrikeh\Precision\Calculator;
use \Shrikeh\Precision\Number;
use \Shrikeh\Precision\Number\DeterministicNumber;

class Infinity implements Number, DeterministicNumber
{
    use \Shrikeh\Precision\Traits\CalculableNumber;
    use \Shrikeh\Precision\Traits\ComparableNumber;
    use \Shrikeh\Precision\Traits\EmbeddedCalculator;

    public static function match($value)
    {
        return (abs($value) === INF);
    }

    public static function getDeterministicValues()
    {
        return array(INF, -INF);
    }

    public function __construct(Calculator $calculator, $value = INF)
    {
        $this->calculator = $calculator;
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function isInfinite()
    {
        return true;
    }

    public function isPositive()
    {
        return ($this->getValue() === INF) ? true : false;
    }

    public function isNegative()
    {
        return ($this->getValue() === -INF) ? true : false;
    }

    public function isZero()
    {
        return false;
    }

    public function isFloat()
    {
        return false;
    }
}
