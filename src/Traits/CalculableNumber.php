<?php
/** @noinspection PhpUndefinedConstantInspection */
namespace Shrikeh\Precision\Traits;

use \Shrikeh\Precision\Number;

trait CalculableNumber
{

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
}
