<?php
namespace Shrikeh\Precision\Calculator\Engine;

use Shrikeh\Precision\Calculator\CalculationFactory;
use \Shrikeh\Precision\Number;
use \Shrikeh\Precision\Calculator\Rounder;
use \Shrikeh\Precision\Calculator\CalculatorEngine;
use \Shrikeh\Precision\Calculator\Engine\FunctorEngine;
use \Shrikeh\Precision\NumberFactory;


class Float implements CalculatorEngine
{
    private $calculationFactory;

    private $functorEngine;

    public function __construct(
        FunctorEngine $functorEngine
    ) {
        $this->calculationFactory   = new CalculationFactory();
        $this->functorEngine        = $functorEngine;
    }

    public function compare(Number $number, Number $comparison, Rounder $rounder)
    {
        return $this->getCalculation('compare', $number, $comparison, $rounder);
    }

    public function add(Number $number, Number $addend, Rounder $rounder)
    {
        return $this->getCalculation('add', $number, $addend, $rounder);
    }

    public function subtract(Number $minuend, Number $subtrahend, Rounder $rounder)
    {
        return $this->getCalculation('subtract', $minuend, $subtrahend, $rounder);
    }

    public function divide(Number $dividend, Number $divisor, Rounder $rounder)
    {
        return $this->getCalculation('divide', $dividend, $divisor, $rounder);
    }

    public function multiply(Number $multiplicand, Number $multiplier, Rounder $rounder)
    {
        return $this->getCalculation('multiply', $multiplicand, $multiplier, $rounder);
    }

    public function validate(array $numbers)
    {
        $isFloat = false;
        foreach ($numbers as $number) {
            if ($this->validateNumber($number)) {
                $isFloat = true;
            }
        }
        return $isFloat;
    }

    private function getCalculationFactory()
    {
        return $this->calculationFactory;
    }

    private function validateNumber(Number $number)
    {
        return ($number->isFloat());
    }

    private function getCalculation(
        $callback,
        Number $leftNumber,
        Number $rightNumber,
        Rounder $rounder
    ) {
        $functor = $this->functorEngine->$callback;

        $calculation = function($scale) use ($functor, $leftNumber, $rightNumber) {
            $leftOperand    = $leftNumber->getValue();
            $rightOperand   = $rightNumber->getValue();
            return $functor($leftOperand, $rightOperand, $scale);
        };
        return $this->getCalculationFactory()->calculation($calculation);
    }
}
