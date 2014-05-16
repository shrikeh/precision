<?php
namespace Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\BCMath;

use \Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\CalculationFunctor;

class Pow implements CalculationFunctor
{
    use \Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\NamedTrait;

    public function __invoke($leftOperand, $exponent, $scale = 0)
    {
        return $this->pow($leftOperand, $exponent, $scale);
    }

    public function pow($leftOperand, $exponent, $scale = 0)
    {
        return bcpow($leftOperand, $exponent, $scale);
    }
}
