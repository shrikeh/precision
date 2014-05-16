<?php

namespace spec\Shrikeh\Precision\Calculator\Calculation;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use \Shrikeh\Precision\Calculator\Rounding\RoundUp;
use \Shrikeh\Precision\Number;
use \Shrikeh\Precision\NumberFactory;

class ClosureCalculationSpec extends ObjectBehavior
{

    function it_is_initializable(NumberFactory $factory)
    {
        $this->beConstructedWith($factory, function() {});
        $this->shouldHaveType('Shrikeh\Precision\Calculator\Calculation\ClosureCalculation');
    }

    function it_returns_a_number(
        NumberFactory $factory,
        RoundUp $roundUp,
        Number $number
    ) {
        $roundUp->round(5.9)->willReturn(5);
        $factory->create(5)->willReturn($number);

        $function = function($rounder) use ($factory) {
            $result = 5.9;
            return $rounder->round($result);
        };
        $this->beConstructedWith($factory, $function);
        $this->calculate($roundUp)->shouldReturn($number);

    }
}
