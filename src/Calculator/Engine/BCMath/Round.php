<?php
namespace Shrikeh\Precision\Calculator\Engine\BCMath;

use \Shrikeh\Precision\Calculator\Engine\Functor\NamedFunctor;

class Round implements NamedFunctor
{
    use \Shrikeh\Precision\Calculator\Engine\Functor\NamedTrait;

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
