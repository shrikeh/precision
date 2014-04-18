<?php
/** @noinspection PhpUndefinedConstantInspection */
namespace Shrikeh\Precision\Traits;

use \Shrikeh\Precision\Number;

trait ComparableNumber
{
    public function isEqualTo(Number $number, $scale = null)
    {
        return ($this->compare($number, $scale) === Number::EQUAL_TO);
    }

    public function isGreaterThan(Number $number, $scale = null)
    {
        return ($this->compare($number, $scale) === Number::GREATER_THAN);
    }

    public function isLessThan(Number $number, $scale = null)
    {
        return ($this->compare($number, $scale) === Number::LESS_THAN);
    }

    public function compare(Number $number, $scale = null)
    {
        return $this->getCalculator()->compare(
            $this,
            $number,
            $scale
        );
    }
}
