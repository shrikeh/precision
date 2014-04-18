<?php
namespace Shrikeh\Precision\Number;

use \Shrikeh\Precision\Calculator;
use \Shrikeh\Precision\Number;
use \Shrikeh\Precision\Number\DeterministicNumber;

class NotANumber implements Number, DeterministicNumber
{
    use \Shrikeh\Precision\Traits\CalculableNumber;
    use \Shrikeh\Precision\Traits\ComparableNumber;
    use \Shrikeh\Precision\Traits\EmbeddedCalculator;

    private $value = NAN;

    public static function match($value)
    {
        return (is_nan($value));
    }

    public static function getDeterministicValues()
    {
        return array(NAN);
    }

    public function __construct(Calculator $calculator)
    {
        $this->calculator = $calculator;
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
        return false;
    }
}
