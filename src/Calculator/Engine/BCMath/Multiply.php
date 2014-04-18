<?php
namespace Shrikeh\Precision\Calculator\Engine\BCMath;

use \Shrikeh\Precision\Calculator\Engine\Functor\NamedFunctor;

class Multiply implements NamedFunctor
{
    use \Shrikeh\Precision\Calculator\Engine\Functor\NamedTrait;

    public function __invoke($leftOperand, $rightOperand, $scale = 0)
    {
        return $this->multiply($leftOperand, $rightOperand, $scale);
    }

    public function multiply($leftOperand, $rightOperand, $scale = 0)
    {
        return bcmul($leftOperand, $rightOperand, $scale);
    }
}
