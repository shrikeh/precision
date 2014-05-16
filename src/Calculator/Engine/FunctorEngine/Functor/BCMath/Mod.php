<?php
namespace Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\BCMath;

use \Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\CalculationFunctor;

class Mod implements CalculationFunctor
{
    use \Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\NamedTrait;

    public function __invoke($leftOperand, $modulus)
    {
        return $this->mod($leftOperand, $modulus);
    }

    public function mod($leftOperand, $modulus)
    {
        return (string) fmod($leftOperand, $modulus);
    }
}
