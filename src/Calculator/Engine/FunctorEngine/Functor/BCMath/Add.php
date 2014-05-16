<?php
namespace Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\BCMath;

use \Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\CalculationFunctor;

class Add implements CalculationFunctor
{
    use \Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\NamedTrait;

    public function __invoke($leftOperand, $rightOperand, $scale = 0)
    {
        return $this->add($leftOperand, $rightOperand, $scale);
    }

    public function add($leftOperand, $rightOperand, $scale = 0)
    {
        return bcadd($leftOperand, $rightOperand, $scale);
    }

}
