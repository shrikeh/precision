<?php

namespace spec\Shrikeh\Precision\Calculator\Engine;

use \PhpSpec\ObjectBehavior;
use \Prophecy\Argument;
use \Shrikeh\Precision\Number;

class InfiniteSpec extends ObjectBehavior
{
    function it_returns_one_when_it_is_larger(
        Number $infinite,
        Number $finite
    )
    {
        $finite->isInfinite()->willReturn(false);
        $infinite->isInfinite()->willReturn(true);

        $finite->getValue()->willReturn(PHP_INT_MAX);
        $infinite->getValue()->willReturn(INF);

        $this->compare($infinite, $finite, 0)->shouldReturn(1);
    }

    function it_returns_zero_when_it_is_equal(
        Number $infinite
    )
    {
        $infinite->isInfinite()->willReturn(true);

        $infinite->getValue()->willReturn(INF);

        $this->compare($infinite, $infinite, 0)->shouldReturn(0);
    }

    function it_returns_minus_one_when_it_is_smaller(
        Number $infinite,
        Number $finite
    )
    {
        $infinite->isInfinite()->willReturn(true);
        $finite->isInfinite()->willReturn(false);

        $infinite->getValue()->willReturn(-INF);
        $finite->getValue()->willReturn(-PHP_INT_MAX);
        $this->compare($infinite, $finite, 0)->shouldReturn(-1);
    }

    function it_returns_minus_one_when_negative_infinity_compared_to_positive_infinity(
        Number $positiveInfinite,
        Number $negativeInfinite
    )
    {
        $positiveInfinite->isInfinite()->willReturn(true);
        $negativeInfinite->isInfinite()->willReturn(false);

        $positiveInfinite->getValue()->willReturn(INF);
        $negativeInfinite->getValue()->willReturn(-INF);
        $this->compare($negativeInfinite, $positiveInfinite, 0)->shouldReturn(-1);
    }

    function it_returns_one_when_positive_infinity_compared_to_negative_infinity(
        Number $positiveInfinite,
        Number $negativeInfinite
    )
    {
        $positiveInfinite->isInfinite()->willReturn(true);
        $negativeInfinite->isInfinite()->willReturn(false);

        $positiveInfinite->getValue()->willReturn(INF);
        $negativeInfinite->getValue()->willReturn(-INF);
        $this->compare($positiveInfinite, $negativeInfinite, 0)->shouldReturn(1);
    }
}
