<?php
namespace Shrikeh\Precision\Calculator\Engine\FunctorEngine;

use \Shrikeh\Precision\Calculator\Engine\FunctorEngine;
use \Shrikeh\Precision\Calculator\Engine\FunctorEngine\FunctorFactory;

class FunctorAggregate implements FunctorEngine
{
    private $functors;

    public function __construct(FunctorFactory $functors)
    {
        $this->functors = $functors;
    }

    public function compare(
        $leftOperand,
        $rightOperand,
        $scale = 0
    )
    {
        return $this->functors[FunctorEngine::COMPARE]($leftOperand, $rightOperand, $scale);
    }

    public function add(
        $leftOperand,
        $rightOperand,
        $scale = 0
    )
    {
        return $this->functors[FunctorEngine::ADD]($leftOperand, $rightOperand, $scale);
    }

    public function subtract(
        $leftOperand,
        $rightOperand,
        $scale = 0
    )
    {
        return $this->functors[FunctorEngine::SUBTRACT]($leftOperand, $rightOperand, $scale);
    }

    public function multiply(
        $leftOperand,
        $rightOperand,
        $scale = 0
    )
    {
        return $this->functors[FunctorEngine::MULTIPLY]($leftOperand, $rightOperand, $scale);
    }

    public function divide(
        $leftOperand,
        $rightOperand,
        $scale = 0
    )
    {
        return $this->functors[FunctorEngine::DIVIDE]($leftOperand, $rightOperand, $scale);
    }

    public function round(
        $number,
        $scale = 0
    )
    {
        return $this->functors[FunctorEngine::ROUND]($number, $scale);
    }

    public function pow(
        $number,
        $exponent,
        $scale = 0)
    {
        return $this->functors[FunctorEngine::POW]($number, $exponent, $scale);
    }

    public function mod(
        $number,
        $exponent,
        $scale = 0)
    {
        return $this->functors[FunctorEngine::MOD]($number, $exponent, $scale);
    }
}
