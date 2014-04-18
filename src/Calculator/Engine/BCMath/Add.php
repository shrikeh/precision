<?php
namespace Shrikeh\Precision\Calculator\Engine\BCMath;

use \Shrikeh\Precision\Calculator\Engine\Functor\NamedFunctor;

class Add implements NamedFunctor
{
    use \Shrikeh\Precision\Calculator\Engine\Functor\NamedTrait;

    public function __invoke($leftOperand, $rightOperand, $scale = 0)
    {
        return $this->add($leftOperand, $rightOperand, $scale);
    }

    public function add($leftOperand, $rightOperand, $scale = 0)
    {
        return bcadd($leftOperand, $rightOperand, $scale);
    }

}
