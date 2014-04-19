<?php
namespace Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\BCMath;

use \Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\NamedFunctor;

class Multiply implements NamedFunctor
{
    use \Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\NamedTrait;

    public function __invoke($leftOperand, $rightOperand, $scale = 0)
    {
        return $this->multiply($leftOperand, $rightOperand, $scale);
    }

    public function multiply($leftOperand, $rightOperand, $scale = 0)
    {
        return bcmul($leftOperand, $rightOperand, $scale);
    }
}