<?php
namespace Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\BCMath;

use \Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\CalculationFunctor;

class Round implements CalculationFunctor
{
    use \Shrikeh\Precision\Calculator\Engine\FunctorEngine\Functor\NamedTrait;

    public function __invoke($number, $scale = 0)
    {
        return $this->round($number, $scale);
    }

    public function round($number, $scale = 0)
    {
        $fix = '5';
        for ($i = 0; $i < $scale; $i++) {
            $fix = "0$fix";
        }
        $number = bcadd($number, "0.$fix", $scale + 1);
        return bcdiv($number, '1.0', $scale);
    }
}
