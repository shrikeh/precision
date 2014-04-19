<?php
namespace Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\BCMath;

use \Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\NamedFunctor;

class Divide implements NamedFunctor
{
    use \Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\NamedTrait;

    public function __invoke($leftOperand, $rightOperand, $scale = 0)
    {
        return $this->divide($leftOperand, $rightOperand, $scale);
    }

    public function divide($leftOperand, $rightOperand, $scale = 0)
    {
        return bcdiv($leftOperand, $rightOperand, $scale);
    }
}
