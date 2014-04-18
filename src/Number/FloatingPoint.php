<?php
namespace Shrikeh\Precision\Number;

use \Shrikeh\Precision\Calculator;
use \Shrikeh\Precision\Number;

class FloatingPoint implements Number
{
    use \Shrikeh\Precision\Traits\CalculableNumber;
    use \Shrikeh\Precision\Traits\ComparableNumber;
    use \Shrikeh\Precision\Traits\EmbeddedCalculator;

    private $value;

    public static function match($value)
    {
        return true;
    }

    public function __construct(Calculator $calculator, $value)
    {
        $this->calculator = $calculator;
        $this->value = $value;
    }

    public function __toString()
    {
        return $this->getValue();
    }

    public function isInfinite()
    {
        return false;
    }

    public function isPositive()
    {
        return ($this->compare($this, $this->zero()) === Number::GREATER_THAN);
    }

    public function isNegative()
    {
        return ($this->compare($this, $this->zero()) === Number::LESS_THAN);
    }

    public function isZero()
    {
        return false;
    }

    public function isFloat()
    {
        return true;
    }

    public function getValue()
    {
        return (string) $this->value;
    }

    public function negate()
    {
        return $this->multiply(new self('-1'));
    }

    public function abs()
    {
        if ($this->isNegative()) {
            return $this->negate();
        }
        return clone $this;
    }

    private function zero()
    {
        return $this->getCalculator()->create(0);
    }
}
