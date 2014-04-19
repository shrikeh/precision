<?php
namespace Shrikeh\Precision\Number;

use \Shrikeh\Precision\Calculator;
use \Shrikeh\Precision\Number;
use \Shrikeh\Precision\Number\DeterministicNumber;

class Zero implements Number, DeterministicNumber
{
    use \Shrikeh\Precision\Traits\CalculableNumber;
    use \Shrikeh\Precision\Traits\ComparableNumber;
    use \Shrikeh\Precision\Traits\EmbeddedCalculator;

    private $value = 0;

    public static function match($value)
    {
        return (floatval($value) === floatval(0));
    }

    public static function getDeterministicValues()
    {
        return array(0);
    }

    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
    }

    public function __toString()
    {
        return (string) $this->getValue();
    }

    public function getValue()
    {
        return $this->value;
    }

    public function isInfinite()
    {
        return false;
    }

    public function isPositive()
    {
        return false;
    }

    public function isNegative()
    {
        return false;
    }

    public function isZero()
    {
        return true;
    }

    public function isFloat()
    {
        return false;
    }
}
