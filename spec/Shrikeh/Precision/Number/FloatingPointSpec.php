<?php

namespace spec\Shrikeh\Precision\Number;

use \PhpSpec\ObjectBehavior;
use \Prophecy\Argument;
use \Shrikeh\Precision\Calculator\Engine\BCMath;
use \Shrikeh\Precision\Calculator\Calculator;
use \Shrikeh\Precision\Number;
use \Shrikeh\Precision\Number\FloatingPoint;

class FloatingPointSpec extends ObjectBehavior
{

    function it_gives_me_back_the_number_i_gave_it()
    {
        $this->beConstructedWith(121.9201347);
        $this->getValue()->shouldReturn('121.9201347');
    }

    function it_gives_me_back_a_clean_value()
    {
        $this->beConstructedWith(121.000000);
        $this->getValue()->shouldReturn('121');
    }

    function it_returns_one_when_it_is_larger(FloatingPoint $precision)
    {
        $this->beConstructedWith(121.9201347);
        $precision->getValue()->willReturn(121.9201346890);
        $this->compare($precision, 10)->shouldReturn(1);
    }

    function it_returns_minus_one_when_it_is_smaller(FloatingPoint $precision)
    {
        $this->beConstructedWith(121.920134684999);
        $precision->getValue()->willReturn(121.9201346890);
        $this->compare($precision, 10)->shouldReturn(-1);
    }

    function it_returns_zero_when_comparing_equally(FloatingPoint $precision)
    {
        $this->beConstructedWith(121.9201347);
        $precision->getValue()->willReturn(121.9201348);
        $this->compare($precision, 6)->shouldReturn(0);
    }

    function it_returns_true_when_it_is_greater_than(FloatingPoint $precision)
    {
        $this->beConstructedWith(121.925);
        $precision->getValue()->willReturn(121.918);
        $this->isGreaterThan($precision)->shouldReturn(true);
    }

    function it_returns_true_when_it_is_less_than(FloatingPoint $precision)
    {
        $this->beConstructedWith(121.914);
        $precision->getValue()->willReturn(121.9201346890);
        $this->isLessThan($precision)->shouldReturn(true);
    }

    function it_returns_true_when_it_is_equal_to(FloatingPoint $precision)
    {
        $this->beConstructedWith(121.9201347);
        $precision->getValue()->willReturn(121.9201348);
        $this->isEqualTo($precision)->shouldReturn(true);
    }

    function it_returns_false_when_a_finite_number_is_compared_to_an_infinite_number(Calculator $calculator)
    {
        $this->beConstructedWith(121.9201347);
        $precision = new FloatingPoint($calculator, INF);
        $this->isGreaterThan($precision)->shouldReturn(false);
    }
}
