<?php
namespace Shrikeh\Precision\Calculator\Engine\BCMath;

use \Shrikeh\Precision\Calculator\Engine\Functor\NamedFunctor;

class Pow implements NamedFunctor
{
    use \Shrikeh\Precision\Calculator\Engine\Functor\NamedTrait;

    public function __invoke($leftOperand, $exponent, $scale = 0)
    {
        return $this->pow($leftOperand, $exponent, $scale);
    }

    public function pow($leftOperand, $exponent, $scale = 0)
    {
        return bcpow($leftOperand, $exponent, $scale);
    }
}
