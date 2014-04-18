<?php
namespace Shrikeh\Precision\Calculator\Engine\BCMath;

use \Shrikeh\Precision\Calculator\Engine\Functor\NamedFunctor;

class Divide implements NamedFunctor
{
    use \Shrikeh\Precision\Calculator\Engine\Functor\NamedTrait;

    public function __invoke($leftOperand, $rightOperand, $scale = 0)
    {
        return $this->divide($leftOperand, $rightOperand, $scale);
    }

    public function divide($leftOperand, $rightOperand, $scale = 0)
    {
        return bcdiv($leftOperand, $rightOperand, $scale);
    }
}
