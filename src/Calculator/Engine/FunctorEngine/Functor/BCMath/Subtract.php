<?php
namespace Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\BCMath;

use \Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\CalculationFunctor;

class Subtract implements CalculationFunctor
{
    use \Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\NamedTrait;

    public function __invoke($leftOperand, $rightOperand, $scale = 0)
    {
        return $this->subtract($leftOperand, $rightOperand, $scale);
    }

    public function subtract($leftOperand, $rightOperand, $scale = 0)
    {
        return bcsub($leftOperand, $rightOperand, $scale);
    }
}
