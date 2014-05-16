<?php
namespace Shrikeh\Precision\Calculator\Calculation;

use \Shrikeh\Precision\Calculator\Calculation;
use \Shrikeh\Precision\Calculator\Rounder;
use \Shrikeh\Precision\NumberFactory;

class ClosureCalculation implements Calculation
{
    private $numberFactory;

    private $calculation;

    public function __construct(
        NumberFactory $numberFactory,
        \Closure $calculation
    ) {
        $this->numberFactory    = $numberFactory;
        $this->calculation      = $calculation;
    }

    public function __invoke(Rounder $rounder)
    {
        return $this->calculate($rounder);
    }

    public function calculate(Rounder $rounder)
    {
        $calculation    = $this->calculation;
        $result         = $calculation($rounder);
        return $this->getNumberFactory()->create($result);
    }

    private function getNumberFactory()
    {
        return $this->numberFactory;
    }
}
