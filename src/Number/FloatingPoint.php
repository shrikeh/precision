<?php
namespace Shrikeh\Precision\Number;

use \Shrikeh\Precision\Number;
use \Shrikeh\Precision\Calculator;
use \Shrikeh\Precision\Calculator\BCMath;

class FloatingPoint implements Number
{
    private $calculator;

    private $value;

    public function __construct($value, $calculator = null)
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
        return ($this->value === INF);
    }

    public function getValue()
    {
        return (string) $this->value;
    }

    public function isEqualTo(Number $number, $scale = null)
    {
        return ($this->compare($number, $scale) === 0);
    }

    public function isGreaterThan(Number $number, $scale = null)
    {
        return ($this->compare($number, $scale) === 1);
    }

    public function isLessThan(Number $number, $scale = null)
    {
        return ($this->compare($number, $scale) === -1);
    }

    public function compare(Number $number, $scale = null)
    {
        return $this->getCalculator()->compare(
            $this,
            $number,
            $scale
        );
    }

    public function add(Number $precision, $scale = null)
    {
        return $this->getCalculator()->add(
            $this,
            $precision,
            $scale
        );
    }

    public function subtract(Number $precision, $scale = null)
    {
        return $this->getCalculator()->subtract(
            $this,
            $precision,
            $scale
        );
    }

    public function divide(Number $precision, $scale = null)
    {
        return $this->getCalculator()->divide(
            $this,
            $precision,
            $scale
        );
    }

    public function multiply(Number $precision, $scale = null)
    {
        return $this->getCalculator()->multiply(
            $this,
            $precision,
            $scale
        );
    }

    public function getCalculator()
    {
        if (!$this->calculator) {
            $this->calculator = new BCMath();
        }
        return $this->calculator;
    }
}
