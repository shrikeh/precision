<?php

namespace spec\Shrikeh\Precision\Number;

use \PhpSpec\ObjectBehavior;
use \Prophecy\Argument;
use \Shrikeh\Precision\Calculator\Engine\BCMath;
use \Shrikeh\Precision\Calculator\Calculator;
use \Shrikeh\Precision\Number;

class FloatingPointSpec extends ObjectBehavior
{

    function it_gives_me_back_the_number_i_gave_it(Calculator $calculator)
    {
        $this->beConstructedWith($calculator, 121.9201347);
        $this->getValue()->shouldReturn('121.9201347');
    }

    function it_gives_me_back_a_clean_value(Calculator $calculator)
    {
        $this->beConstructedWith($calculator, 121.000000);
        $this->getValue()->shouldReturn('121');
    }

    function it_returns_one_when_it_is_larger(Calculator $calculator, Number $precision)
    {
        $this->beConstructedWith($calculator, 121.9201347);
        $calculator->compare($this, $precision, 10)->willReturn(1);
        $this->compare($precision, 10)->shouldReturn(Number::GREATER_THAN);
    }

    function it_returns_minus_one_when_it_is_smaller(Calculator $calculator, Number $precision)
    {
        $this->beConstructedWith($calculator, 121.920134684999);
        $calculator->compare($this, $precision, 10)->willReturn(Number::LESS_THAN);
        $this->compare($precision, 10)->shouldReturn(Number::LESS_THAN);
    }

    function it_returns_zero_when_comparing_equally(Calculator $calculator, Number $precision)
    {
        $this->beConstructedWith($calculator, 121.9201347);
        $calculator->compare($this, $precision, 6)->willReturn(Number::EQUAL_TO);
        $this->compare($precision, 6)->shouldReturn(Number::EQUAL_TO);
    }

    function it_returns_true_when_it_is_greater_than(Calculator $calculator, Number $precision)
    {
        $this->beConstructedWith($calculator, 121.925);
        $calculator->compare($this, $precision, null)->willReturn(Number::GREATER_THAN);
        $this->isGreaterThan($precision)->shouldReturn(true);
    }

    function it_returns_true_when_it_is_less_than(Calculator $calculator, Number $precision)
    {
        $this->beConstructedWith($calculator, 121.914);
        $calculator->compare($this, $precision, null)->willReturn(Number::LESS_THAN);
        $this->isLessThan($precision)->shouldReturn(true);
    }

    function it_returns_true_when_it_is_equal_to(Calculator $calculator, Number $precision)
    {
        $this->beConstructedWith($calculator, 121.9201347);
        $calculator->compare($this, $precision, null)->willReturn(Number::EQUAL_TO);
        $this->isEqualTo($precision)->shouldReturn(true);
    }
}
