<?php
namespace Shrikeh\Precision\Calculator\Engine;

use \Shrikeh\Precision\Number;
use \Shrikeh\Precision\Calculator\CalculatorEngine;
use \Shrikeh\Precision\Calculator\Engine\FunctorEngine;
use \Shrikeh\Precision\NumberFactory;


class Float implements CalculatorEngine
{
    private $factory;

    private $functorEngine;

    public function __construct(
        NumberFactory $factory,
        FunctorEngine $functorEngine
    ) {
        $this->factory          = $factory;
        $this->functorEngine    = $functorEngine;
    }

    public function compare(Number $number, Number $comparison, $scale)
    {
        return $this->getResult('compare', $number, $comparison, $scale);
    }

    public function add(Number $number, Number $addend, $scale)
    {
        return $this->getResult('add', $number, $addend, $scale);
    }

    public function subtract(Number $minuend, Number $subtrahend, $scale)
    {
        return $this->getResult('subtract', $minuend, $subtrahend, $scale);
    }

    public function divide(Number $dividend, Number $divisor, $scale)
    {
        return $this->getResult('divide', $dividend, $divisor, $scale);
    }

    public function multiply(Number $multiplicand, Number $multiplier, $scale)
    {
        return $this->getResult('multiply', $multiplicand, $multiplier, $scale);
    }

    public function round(Number $number, $scale)
    {
        $value      = $number->getValue();
        $result     = $this->functorEngine->round($value, $scale);
        return $this->factory->create($result);
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

    private function validateNumber(Number $number)
    {
        return ($number->isFloat());
    }

    private function getResult(
        $callback,
        Number $leftNumber,
        Number $rightNumber,
        $scale
    ) {
        $leftOperand    = $leftNumber->getValue();
        $rightOperand   = $rightNumber->getValue();
        $result         = $this->functorEngine->$callback($leftOperand, $rightOperand, $scale);

        return $this->factory->create($result);
    }
}
