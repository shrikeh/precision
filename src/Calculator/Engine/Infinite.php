<?php
namespace Shrikeh\Precision\Calculator\Engine;

use \Shrikeh\Precision\Calculator\CalculatorEngine;
use \Shrikeh\Precision\Number;

class Infinite implements CalculatorEngine
{
    private $functors;

    public function __construct(FunctorFactory $functorFactory)
    {
        $this->functors = $functorFactory;
    }

    public function compare(Number $leftOperand, Number $rightOperand, $precision)
    {

    }

    public function divide(Number $leftOperand, Number $rightOperand, $precision)
    {

    }

    public function multiply(Number $leftOperand, Number $rightOperand, $precision)
    {

    }

    public function add(Number $leftOperand, Number $rightOperand, $precision)
    {

    }

    public function subtract(Number $leftOperand, Number $rightOperand, $precision)
    {

    }

    public function pow(Number $leftOperand, Number $rightOperand, $precision)
    {

    }

    private function map(Number $number)
    {
        return (!$number->isInfinite()) ? ceil($number->getValue()) : $number->getValue();
    }


    public function validate(array $numbers)
    {
        $isInfinite = false;
        foreach ($numbers as $number) {
            if ($number->isInfinite()) {
                $isInfinite = true;
            }
        }
        return $isInfinite;
    }
}
