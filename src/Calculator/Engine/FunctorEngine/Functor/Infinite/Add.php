<?php

namespace Shrikeh\Precision\Calculator\Engine\Infinite;

use \Shrikeh\Precision\Calculator\Engine\Functor\NamedFunctor;

class Add implements NamedFunctor
{
    use \Shrikeh\Precision\Calculator\Engine\Functor\NamedTrait;

    public function __invoke($leftOperand, $rightOperand, $scale = null)
    {
        return $this->add($leftOperand, $rightOperand, $scale);
    }

    public function add($leftOperand, $rightOperand, $scale = null)
    {
        return $leftOperand + $rightOperand;
    }


}
