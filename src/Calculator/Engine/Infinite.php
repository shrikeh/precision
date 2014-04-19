<?php
namespace Shrikeh\Precision\Calculator\Engine;

use \Shrikeh\Precision\Number;
use \Shrikeh\Precision\Calculator\CalculatorEngine;
use \Shrikeh\Precision\Calculator\Engine\FunctorEngine;
use \Shrikeh\Precision\NumberFactory;

class Infinite implements CalculatorEngine
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

    public function compare(Number $leftOperand, Number $rightOperand, $scale)
    {

    }

    public function divide(Number $leftOperand, Number $rightOperand, $scale)
    {

    }

    public function multiply(Number $leftOperand, Number $rightOperand, $scale)
    {

    }

    public function add(Number $leftOperand, Number $rightOperand, $scale)
    {

    }

    public function subtract(Number $leftOperand, Number $rightOperand, $scale)
    {

    }

    public function pow(Number $leftOperand, Number $rightOperand, $scale)
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
            if ($this->validateNumber($number)) {
                $isInfinite = true;
            }
        }
        return $isInfinite;
    }

    private function validateNumber(Number $number)
    {
        return ($number->isInfinite());
    }
}
