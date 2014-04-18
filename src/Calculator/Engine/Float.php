<?php
namespace Shrikeh\Precision\Calculator\Engine;

use \Shrikeh\Precision\Number;
use \Shrikeh\Precision\Calculator\CalculatorEngine;
use \Shrikeh\Precision\Calculator\Engine\FunctorFactory;


class Float implements CalculatorEngine
{
    private $functors;

    public function __construct(FunctorFactory $functorFactory)
    {
        $this->functors = $functorFactory;
    }

    public function compare(
        Number $leftNumber,
        Number $rightNumber,
        $scale = 0
    )
    {
        return $this->performCallback(FunctorFactory::COMPARE, $leftNumber, $rightNumber, $scale);
    }

    public function add(
        Number $leftNumber,
        Number $rightNumber,
        $scale = 0
    )
    {
        return $this->performCallback(FunctorFactory::ADD, $leftNumber, $rightNumber, $scale);
    }

    public function subtract(
        Number $leftNumber,
        Number $rightNumber,
        $scale = 0
    )
    {
        return $this->performCallback(FunctorFactory::SUBTRACT, $leftNumber, $rightNumber, $scale);
    }

    public function multiply(
        Number $leftNumber,
        Number $rightNumber,
        $scale = 0
    )
    {
        return $this->performCallback(FunctorFactory::MULTIPLY, $leftNumber, $rightNumber, $scale);
    }

    public function divide(
        Number $leftNumber,
        Number $rightNumber,
        $scale = 0
    )
    {
        return $this->performCallback(FunctorFactory::DIVIDE, $leftNumber, $rightNumber, $scale);
    }

    public function round(
        Number $leftNumber,
        $scale = 0
    )
    {
        return $this->functors[FunctorFactory::ROUND]($leftNumber, $scale);
    }

    public function pow(
        Number $number,
        Number $exponent,
        $scale = 0)
    {
        return $this->performCallback(FunctorFactory::POW, $number, $exponent, $scale);
    }

    public function mod(
        Number $number,
        Number $exponent,
        $scale = 0)
    {
        return $this->performCallback(FunctorFactory::MOD, $number, $exponent, $scale);
    }

    public function validate(array $args)
    {
        $isFloat = false;
        foreach ($args as $arg) {
            if ($arg->isFloat()) {
                $isFloat = true;
            }
        }
        return $isFloat;
    }

    private function performCallback($callback, $leftNumber, $rightNumber, $scale)
    {
        $leftOperand = $leftNumber->getValue();
        $rightOperand = $rightNumber->getValue();
        return $this->functors[$callback]($leftOperand, $rightOperand, $scale);
    }
}
