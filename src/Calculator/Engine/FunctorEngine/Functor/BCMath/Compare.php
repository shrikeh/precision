<?php
namespace Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\BCMath;

use \Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\CalculationFunctor;

class Compare implements CalculationFunctor
{
    use \Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\NamedTrait;

    public function __invoke($leftOperand, $rightOperand, $scale = 0)
    {
        return $this->compare($leftOperand, $rightOperand, $scale);
    }

    public function compare($leftOperand, $rightOperand, $scale = 0)
    {
        return bccomp($leftOperand, $rightOperand, $scale);
    }
}
