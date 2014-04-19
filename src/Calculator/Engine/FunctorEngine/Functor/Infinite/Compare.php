<?php

namespace Shrikeh\Precision\Calculator\Engine\Infinite;

use \Shrikeh\Precision\Calculator\Engine\Functor\NamedFunctor;
use \Shrikeh\Precision\Number;

class Compare implements NamedFunctor
{
    use \Shrikeh\Precision\Calculator\Engine\Functor\NamedTrait;

    public function __invoke($leftOperand, $rightOperand, $scale = null)
    {
        return $this->compare($leftOperand, $rightOperand, $scale);
    }

    public function compare($leftOperand, $rightOperand, $scale = null)
    {
        if ($leftOperand > $rightOperand) {
            $result = Number::GREATER_THAN;
        } elseif ($rightOperand > $leftOperand) {
            $result = Number::LESS_THAN;
        } else {
            $result = Number::EQUAL_TO;
        }
        return $result;
    }

}
