<?php

namespace spec\Shrikeh\Precision\Calculator\Engine;

use \PhpSpec\ObjectBehavior;
use \Prophecy\Argument;
use \Shrikeh\Precision\Number;
use \Shrikeh\Precision\Calculator\Rounding\RoundUp;

class FloatSpec extends ObjectBehavior
{
    public function let($factory, $functorEngine)
    {
        $functorEngine->beADoubleOf('\Shrikeh\Precision\Calculator\Engine\FunctorEngine');
        $this->beConstructedWith($factory, $functorEngine);
    }

    function it_is_initializable() {
        $this->shouldHaveType('Shrikeh\Precision\Calculator\Engine\Float');
    }

    function it_returns_a_calculation(
        $functorEngine,
        $factory,
        Number $number,
        Number $addend,
        Number $result
    )
    {
        $rounder = new RoundUp(4);
        $number->getValue()->willReturn('1.991919191');
        $addend->getValue()->willReturn('7.0234545');


        $functorEngine->add('1.991919191', '7.0234545')->willReturn('13.9901538057');
        $factory->create('13.9902')->willReturn($result);
        $this->add($number, $addend, $rounder);
    }

}
